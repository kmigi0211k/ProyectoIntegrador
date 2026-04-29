<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VolunteerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_can_register_for_volunteer_work()
    {
        // 1. Arrange: Crear un usuario y un producto
        $user = User::factory()->create([
            'user_name' => 'voluntario123',
            'password' => bcrypt('password123'),
        ]);
        
        $product = Product::factory()->create([
            'name' => 'Kit de Herramientas',
            'price' => 50000,
        ]);

        $volunteerData = [
            'help_type' => 'Limpieza de parque comunitario',
            'hours_committed' => 10,
            'details' => 'Ayudaré con la limpieza el próximo sábado.',
        ];

        // 2. Act: Realizar la petición POST
        $response = $this->actingAs($user)
                         ->post(route('volunteers.store', $product->id), $volunteerData);

        // 3. Assert: Verificar que se redirigió a WhatsApp y se creó el registro
        $response->assertRedirect();
        $this->assertStringContainsString('https://api.whatsapp.com/send', $response->headers->get('Location'));
        $this->assertStringContainsString(urlencode('Limpieza de parque comunitario'), $response->headers->get('Location'));

        $this->assertDatabaseHas('volunteers', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'help_type' => 'Limpieza de parque comunitario',
            'hours_committed' => 10,
            'status' => 'pending',
        ]);
    }

    /** @test */
    public function guest_users_cannot_register_for_volunteer_work()
    {
        $product = Product::factory()->create();

        $response = $this->post(route('volunteers.store', $product->id), [
            'help_type' => 'Ayuda',
            'hours_committed' => 5,
        ]);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseCount('volunteers', 0);
    }

    /** @test */
    public function volunteer_registration_requires_valid_data()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $response = $this->actingAs($user)
                         ->post(route('volunteers.store', $product->id), [
                             'help_type' => '', // Required
                             'hours_committed' => 0, // Min 1
                         ]);

        $response->assertSessionHasErrors(['help_type', 'hours_committed']);
        $this->assertDatabaseCount('volunteers', 0);
    }
}
