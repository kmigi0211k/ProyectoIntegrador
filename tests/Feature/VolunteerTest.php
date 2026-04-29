<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VolunteerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_usuario_autenticado_puede_registrarse_como_voluntario()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $response = $this->actingAs($user)
                         ->post(route('volunteers.store', $product->id), [
                             'help_type' => 'Ayuda Comunitaria',
                             'hours_committed' => 10,
                         ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('volunteers', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
    }
}
