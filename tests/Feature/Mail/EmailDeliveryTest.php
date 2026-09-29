<?php

namespace Tests\Feature\Mail;

use App\Mail\HolidayReminderMail;
use App\Mail\OrderConfirmationMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\Concerns\CreatesBloomGiftData;
use Tests\TestCase;

class EmailDeliveryTest extends TestCase
{
    use CreatesBloomGiftData, RefreshDatabase {
        CreatesBloomGiftData::afterRefreshingDatabase insteadof RefreshDatabase;
    }

    public function test_order_confirmation_mail_can_be_sent_to_the_customer(): void
    {
        Mail::fake();
        $customer = $this->createCustomer();
        $order = $this->createOrder($customer);
        $html = (new OrderConfirmationMail($order))->render();

        Mail::to($customer->email)->send(new OrderConfirmationMail($order));

        $this->assertStringContainsString($order->order_code, $html);
        Mail::assertSent(OrderConfirmationMail::class, function (OrderConfirmationMail $mail) use ($customer, $order): bool {
            return $mail->hasTo($customer->email) && $mail->order->is($order);
        });
    }

    public function test_upcoming_holiday_command_sends_to_active_customers_two_days_before_the_event(): void
    {
        Mail::fake();
        $customer = $this->createCustomer();
        $this->createAdmin();

        $this->artisan('reminder:upcoming-holidays', ['--date' => '2026-02-12'])
            ->expectsOutput('Lễ Tình nhân Valentine: đã gửi 1 email, lỗi 0 email.')
            ->assertSuccessful();

        Mail::assertSent(HolidayReminderMail::class, function (HolidayReminderMail $mail) use ($customer): bool {
            return $mail->hasTo($customer->email)
                && $mail->holidayName === 'Lễ Tình nhân Valentine'
                && $mail->voucherCode === null;
        });
        Mail::assertSent(HolidayReminderMail::class, 1);
    }

    public function test_manual_holiday_command_can_send_to_an_explicit_test_address_without_querying_customers(): void
    {
        Mail::fake();

        $this->artisan('reminder:holiday', [
            '--holiday' => 'Test email',
            '--to' => 'owner@example.test',
        ])->assertSuccessful();

        Mail::assertSent(HolidayReminderMail::class, function (HolidayReminderMail $mail): bool {
            return $mail->hasTo('owner@example.test')
                && $mail->holidayName === 'Test email';
        });
    }
}
