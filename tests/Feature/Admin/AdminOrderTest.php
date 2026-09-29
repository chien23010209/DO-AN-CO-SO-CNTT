<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesBloomGiftData;
use Tests\TestCase;

class AdminOrderTest extends TestCase
{
    use CreatesBloomGiftData, RefreshDatabase {
        CreatesBloomGiftData::afterRefreshingDatabase insteadof RefreshDatabase;
    }

    public function test_admin_can_view_order_index_with_order_code(): void
    {
        $admin = $this->createAdmin();
        $order = $this->createOrder($this->createCustomer());

        $response = $this->actingAs($admin)->get(route('admin.orders.index'));

        $response->assertOk()->assertSee($order->order_code);
    }

    public function test_admin_can_view_order_detail(): void
    {
        $admin = $this->createAdmin();
        $order = $this->createOrder($this->createCustomer());

        $response = $this->actingAs($admin)->get(route('admin.orders.show', $order));

        $response->assertOk()->assertSee($order->order_code);
    }

    public function test_admin_can_update_order_status_to_shipping(): void
    {
        $admin = $this->createAdmin();
        $order = $this->createOrder($this->createCustomer());

        $response = $this->actingAs($admin)
            ->from(route('admin.orders.show', $order))
            ->patch(route('admin.orders.update-status', $order), ['order_status' => 'shipping']);

        $response->assertRedirect(route('admin.orders.show', $order));
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'order_status' => 'shipping',
            'status' => 'SHIPPING',
        ]);
    }

    public function test_customer_cannot_access_admin_orders(): void
    {
        $customer = $this->createCustomer();

        $response = $this->actingAs($customer)->get(route('admin.orders.index'));

        $response->assertForbidden();
    }
}
