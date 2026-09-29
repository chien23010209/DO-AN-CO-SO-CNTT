<?php

namespace Tests\Feature\Cart;

use App\Models\CartItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesBloomGiftData;
use Tests\TestCase;

class CartTest extends TestCase
{
    use CreatesBloomGiftData, RefreshDatabase {
        CreatesBloomGiftData::afterRefreshingDatabase insteadof RefreshDatabase;
    }

    public function test_customer_can_add_a_product_to_the_cart(): void
    {
        $customer = $this->createCustomer();
        $product = $this->createProduct();

        $response = $this->actingAs($customer)
            ->from(route('products.index'))
            ->post(route('cart.add', ['id' => $product->id]), ['quantity' => 1]);

        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('cart_items', [
            'user_id' => $customer->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => 350000,
            'subtotal' => 350000,
        ]);
    }

    public function test_customer_can_update_cart_item_quantity(): void
    {
        $customer = $this->createCustomer();
        $product = $this->createProduct();
        $cartItem = CartItem::create([
            'user_id' => $customer->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => 350000,
            'subtotal' => 350000,
        ]);

        $response = $this->actingAs($customer)
            ->patch(route('cart.update', $cartItem), ['quantity' => 2]);

        $response->assertRedirect(route('cart.index'));
        $this->assertDatabaseHas('cart_items', [
            'id' => $cartItem->id,
            'quantity' => 2,
            'price' => 350000,
        ]);
    }

    public function test_customer_can_remove_an_item_from_the_cart(): void
    {
        $customer = $this->createCustomer();
        $product = $this->createProduct();
        $cartItem = CartItem::create([
            'user_id' => $customer->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => 350000,
            'subtotal' => 350000,
        ]);

        $response = $this->actingAs($customer)
            ->from(route('cart.index'))
            ->delete(route('cart.remove', $cartItem));

        $response->assertRedirect(route('cart.index'));
        $this->assertDatabaseMissing('cart_items', ['id' => $cartItem->id]);
    }

    public function test_cart_index_calculates_total_from_item_price_and_quantity(): void
    {
        $customer = $this->createCustomer();
        $product = $this->createProduct();
        CartItem::create([
            'user_id' => $customer->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'price' => 350000,
            'subtotal' => 700000,
        ]);

        $response = $this->actingAs($customer)->get(route('cart.index'));

        $response->assertOk()
            ->assertViewHas('subtotal', 700000.0)
            ->assertViewHas('total', 700000.0);
    }
}
