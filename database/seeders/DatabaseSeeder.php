<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Types of Documents
        \App\Models\TypeDocument::create(['description' => 'Cedula']);
        \App\Models\TypeDocument::create(['description' => 'Pasaporte']);
        \App\Models\TypeDocument::create(['description' => 'PEP']);

        // Roles
        \App\Models\Role::create(['description' => 'Admin', 'status' => 1]);
        \App\Models\Role::create(['description' => 'Secretary', 'status' => 0]);

        // Person
        $person = \App\Models\Person::create([
            'document' => '1033257422',
            'names' => 'Juan Camilo',
            'last_name' => 'Giraldo',
            'email' => 'juankamilo0211k@gmail.com',
            'phone' => '3023850997',
            'address' => 'calle 48 E # 93-53',
            'birthdate' => '2005-02-11',
            'type_document_id' => 1
        ]);

        // User
        \App\Models\User::create([
            'user_name' => 'Juan0211',
            'password' => \Illuminate\Support\Facades\Hash::make('1234'),
            'status' => 1,
            'person_id' => $person->id,
            'role_id' => 1
        ]);

        // Product
        \App\Models\Product::create([
            'name' => 'Laptop Dell XPS 13',
            'description' => 'Laptop ultradelgada con procesador Intel i7',
            'price' => 1500000,
            'stock' => 25,
            'creation_date' => '2024-11-26'
        ]);
    }
}
