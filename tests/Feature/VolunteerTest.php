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
        // 1. Arrange
        $user = User::factory()->create();
        $product = Product::factory()->create(['name' => 'Producto Test']);

        $volunteerData = [
            'help_type' => 'Ayuda en Limpieza',
            'hours_committed' => 10,
            'details' => 'Ayudaré el fin de semana'
        ];

        // 2. Act
        $response = $this->actingAs($user)
                         ->post(route('volunteers.store', $product->id), $volunteerData);

        // 3. Assert
        $response->assertRedirect();
        $this->assertDatabaseHas('volunteers', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'help_type' => 'Ayuda en Limpieza',
            'hours_committed' => 10,
            'status' => 'pending',
        ]);
    }

    /** @test */
    public function un_invitado_no_puede_registrarse_como_voluntario()
    {
        $product = Product::factory()->create();

        $response = $this->post(route('volunteers.store', $product->id), [
            'help_type' => 'Ayuda',
            'hours_committed' => 5,
        ]);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseCount('volunteers', 0);
    }
}
