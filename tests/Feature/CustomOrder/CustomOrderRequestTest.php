<?php

namespace Tests\Feature\CustomOrder;

use App\Models\CustomOrderRequest;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesBloomGiftData;
use Tests\TestCase;

class CustomOrderRequestTest extends TestCase
{
    use CreatesBloomGiftData, RefreshDatabase {
        CreatesBloomGiftData::afterRefreshingDatabase insteadof RefreshDatabase;
    }

    public function test_guest_can_submit_a_custom_order_request(): void
    {
        $response = $this->post(route('custom.order.store'), $this->requestData());

        $request = CustomOrderRequest::query()->firstOrFail();
        $response->assertRedirect(route('custom.order'));
        $this->assertDatabaseHas('custom_order_requests', [
            'id' => $request->id,
            'customer_name' => 'Nguyễn Thị Hoa',
            'status' => 'pending',
            'user_id' => null,
        ]);
        $this->assertStringStartsWith('YC', $request->request_code);
    }

    public function test_authenticated_customer_request_is_linked_to_their_account(): void
    {
        $customer = $this->createCustomer();

        $response = $this->actingAs($customer)->post(route('custom.order.store'), $this->requestData());

        $response->assertRedirect(route('custom.order'));
        $this->assertDatabaseHas('custom_order_requests', [
            'user_id' => $customer->id,
            'status' => 'pending',
        ]);
    }

    public function test_admin_can_view_custom_order_request_list(): void
    {
        $admin = $this->createAdmin();
        $request = $this->createCustomOrderRequest($this->createCustomer());

        $response = $this->actingAs($admin)->get(route('admin.custom-orders.index'));

        $response->assertOk()->assertSee($request->request_code);
    }

    public function test_admin_can_accept_a_pending_custom_order_request(): void
    {
        $admin = $this->createAdmin();
        $request = $this->createCustomOrderRequest($this->createCustomer());

        $response = $this->actingAs($admin)
            ->from(route('admin.custom-orders.show', $request))
            ->patch(route('admin.custom-orders.accept', $request), [
                'admin_note' => 'Đã liên hệ và nhận yêu cầu.',
            ]);

        $response->assertRedirect(route('admin.custom-orders.show', $request));
        $request->refresh();
        $this->assertSame('accepted', $request->status);
        $this->assertSame('Đã liên hệ và nhận yêu cầu.', $request->admin_note);
        $this->assertNotNull($request->accepted_at);
        $this->assertNotNull($request->responded_at);
    }

    public function test_admin_can_create_an_order_from_an_accepted_custom_request(): void
    {
        $admin = $this->createAdmin();
        $customer = $this->createCustomer();
        $request = $this->createCustomOrderRequest($customer, ['status' => 'accepted']);
        $product = $this->createProduct();
        $slot = $this->createDeliverySlot();

        $response = $this->actingAs($admin)->post(
            route('admin.custom-orders.create-order.store', $request),
            [
                'product_id' => $product->id,
                'quantity' => 2,
                'unit_price' => 350000,
                'shipping_fee' => 30000,
                'discount' => 0,
                'payment_method' => 'cod',
                'delivery_slot_id' => $slot->id,
                'delivery_date' => now()->addDay()->toDateString(),
                'recipient_name' => 'Nguyễn Thị Hoa',
                'recipient_phone' => '0901234567',
                'recipient_address' => '123 Đường Hoa, Quận 1, TP.HCM',
                'order_note' => 'Giao trong buổi sáng.',
            ]
        );

        $order = Order::query()->latest('id')->firstOrFail();
        $response->assertRedirect(route('admin.orders.show', $order));
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'user_id' => $customer->id,
            'total' => 730000,
            'payment_method' => 'cod',
            'payment_status' => 'pending',
        ]);
        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'price' => 350000,
            'subtotal' => 700000,
        ]);
        $this->assertDatabaseHas('payments', [
            'order_id' => $order->id,
            'payment_method' => 'cod',
            'amount' => 730000,
            'status' => 'pending',
        ]);
        $this->assertDatabaseHas('custom_order_requests', [
            'id' => $request->id,
            'order_id' => $order->id,
            'status' => 'converted',
        ]);
    }

    private function requestData(): array
    {
        return [
            'customer_name' => 'Nguyễn Thị Hoa',
            'phone' => '0901234567',
            'email' => 'hoa@example.test',
            'occasion' => 'Sinh nhật',
            'flower_type' => 'Hoa hồng',
            'quantity' => 12,
            'budget' => 500000,
            'delivery_date' => now()->addDay()->toDateString(),
            'delivery_address' => '123 Đường Hoa, Quận 1, TP.HCM',
            'message' => 'Xin gói hoa tông màu đỏ.',
        ];
    }
}
