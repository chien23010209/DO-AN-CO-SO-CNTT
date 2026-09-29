<?php

namespace App\Services;

use App\Mail\HolidayReminderMail;
use App\Models\User;
use Carbon\CarbonInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class HolidayReminderService
{
    /**
     * Send a supervised test reminder to one explicit address. This path does
     * not query or modify customer records.
     */
    public function sendTo(string $email, string $holidayName, ?string $voucherCode = null): bool
    {
        try {
            $recipient = (object) ['name' => 'bạn'];

            Mail::to($email)->send(new HolidayReminderMail($recipient, $holidayName, $voucherCode));

            return true;
        } catch (\Throwable $exception) {
            Log::warning('Không thể gửi email nhắc dịp lễ BloomGift tới địa chỉ test.', [
                'holiday' => $holidayName,
                'error' => $exception->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * Return the configured fixed-date occasions that are within the reminder
     * window. This method only reads configuration; it never writes data.
     *
     * @return array<int, array{name: string, voucher_code: ?string}>
     */
    public function campaignsDue(CarbonInterface $date): array
    {
        $reminderDays = collect(config('marketing.holiday_reminder_days', [2]))
            ->map(fn ($day) => (int) $day)
            ->filter(fn (int $day) => $day >= 0)
            ->unique()
            ->all();

        return collect(config('marketing.holiday_campaigns', []))
            ->filter(function (array $campaign) use ($date, $reminderDays): bool {
                [$month, $day] = array_map('intval', explode('-', $campaign['month_day']));
                $holidayDate = $date->copy()->setDate($date->year, $month, $day)->startOfDay();
                $daysUntilHoliday = (int) $date->copy()->startOfDay()->diffInDays($holidayDate, false);

                return in_array($daysUntilHoliday, $reminderDays, true);
            })
            ->map(fn (array $campaign) => [
                'name' => $campaign['name'],
                'voucher_code' => $campaign['voucher_code'] ?? null,
            ])
            ->values()
            ->all();
    }

    /**
     * Send a campaign to active customer accounts without modifying user data.
     * A null limit sends to every matching customer; a positive limit is useful
     * for a supervised manual preview.
     *
     * @return array{sent: int, failed: int}
     */
    public function send(string $holidayName, ?string $voucherCode = null, ?int $limit = null): array
    {
        $query = User::query()
            ->where('role', 'customer')
            ->where('is_active', true)
            ->whereNotNull('email')
            ->orderBy('id');

        if ($limit !== null) {
            $query->limit($limit);
        }

        $result = ['sent' => 0, 'failed' => 0];

        $query->each(function (User $user) use (&$result, $holidayName, $voucherCode): void {
            try {
                Mail::to($user->email)->send(new HolidayReminderMail($user, $holidayName, $voucherCode));
                $result['sent']++;
            } catch (\Throwable $exception) {
                $result['failed']++;

                Log::warning('Không thể gửi email nhắc dịp lễ BloomGift.', [
                    'user_id' => $user->id,
                    'holiday' => $holidayName,
                    'error' => $exception->getMessage(),
                ]);
            }
        });

        return $result;
    }
}
