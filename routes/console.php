<?php

use App\Services\HolidayReminderService;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('reminder:holiday {--holiday=Ngày đặc biệt} {--code=} {--limit=5} {--to=}', function () {
    $holiday = $this->option('holiday');
    $code = trim((string) $this->option('code')) ?: null;
    $limit = max(1, (int) $this->option('limit'));
    $recipient = trim((string) $this->option('to'));

    $this->info("Đang bắt đầu chiến dịch gửi thư nhắc lễ: {$holiday}...");

    if ($recipient !== '') {
        if (! filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
            $this->error('Địa chỉ email ở tùy chọn --to không hợp lệ.');

            return 1;
        }

        $sent = app(HolidayReminderService::class)->sendTo($recipient, $holiday, $code);
        $this->info($sent ? 'Đã gửi 1 email test.' : 'Gửi email test thất bại. Xem storage/logs/laravel.log.');

        return $sent ? 0 : 1;
    }

    $result = app(HolidayReminderService::class)->send($holiday, $code, $limit);

    $this->info("Đã gửi {$result['sent']} email, lỗi {$result['failed']} email.");
})->purpose('Gửi email nhắc dịp lễ; dùng --to để gửi test an toàn tới một địa chỉ chỉ định');

Artisan::command('reminder:upcoming-holidays {--date=}', function () {
    try {
        $date = $this->option('date')
            ? CarbonImmutable::parse($this->option('date'), config('app.timezone'))
            : CarbonImmutable::now(config('app.timezone'));
    } catch (\Throwable) {
        $this->error('Ngày không hợp lệ. Dùng định dạng YYYY-MM-DD.');

        return 1;
    }

    $service = app(HolidayReminderService::class);
    $campaigns = $service->campaignsDue($date);

    if ($campaigns === []) {
        $this->info('Không có dịp lễ nào nằm trong khung nhắc hôm nay.');

        return 0;
    }

    foreach ($campaigns as $campaign) {
        $result = $service->send($campaign['name'], $campaign['voucher_code']);
        $this->info("{$campaign['name']}: đã gửi {$result['sent']} email, lỗi {$result['failed']} email.");
    }

    return 0;
})->purpose('Gửi tự động email nhắc các dịp lễ sắp tới cho khách hàng đang hoạt động');

Schedule::command('reminder:upcoming-holidays')
    ->dailyAt(config('marketing.holiday_reminder_time', '09:00'))
    ->withoutOverlapping();
