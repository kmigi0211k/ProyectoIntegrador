<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function un_usuario_pueden_procesar_un_pedido_y_el_stock_se_descuenta()
    {
        $product = Product::factory()->create([
            'price' => 100,
            'stock' => 10
        ]);

        // Mock cart in session
        $cart = [
            $product->id => [
                'name' => $product->name,
                'quantity' => 2,
                'price' => $product->price,
                'image' => $product->image
            ]
        ];

        $response = $this->actingAs($this->user)
                         ->withSession(['cart' => $cart])
                         ->post(route('orders.process'));

        $this->assertDatabaseHas('orders', [
            'user_id' => $this->user->id,
            'total' => 200,
            'status' => 'completed'
        ]);

        // Check stock deduction
        $this->assertEquals(8, $product->fresh()->stock);

        // Check cart is empty
        $response->assertSessionMissing('cart');
    }

    /** @test */
    public function un_pedido_no_se_puede_procesar_si_el_stock_es_insuficiente()
    {
        $product = Product::factory()->create([
            'stock' => 1
        ]);

        $cart = [
            $product->id => [
                'name' => $product->name,
                'quantity' => 5,
                'price' => $product->price,
                'image' => $product->image
            ]
        ];

        $response = $this->actingAs($this->user)
                         ->withSession(['cart' => $cart])
                         ->post(route('orders.process'));

        $response->assertSessionHas('error');
        $this->assertEquals(1, $product->fresh()->stock); // Stock remains the same
    }
}
