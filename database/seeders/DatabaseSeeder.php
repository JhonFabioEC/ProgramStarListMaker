<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Department;
use App\Models\Municipality;
use App\Models\RoleType;
use App\Models\DocumentType;
use App\Models\User;
use App\Models\Person;
use App\Models\EstablishmentType;
use App\Models\Establishment;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        Department::factory(5)->create();
        Municipality::factory(5)->create();

        RoleType::factory()->create([
            'name' => 'Administrador',
            'color' => '#b0d89a'
        ]);

        RoleType::factory()->create([
            'name' => 'Establecimiento',
            'color' => '#f8bca4'
        ]);

        RoleType::factory()->create([
            'name' => 'Usuario',
            'color' => '#fff5a0'
        ]);

        DocumentType::factory(5)->create();

        User::factory()->create([
            'image' => 'https://picsum.photos/640/480?random=42738',
            'username' => 'admin',
            'email_address' => 'admin@prueba.test',
            'password' => '1q2w3e4r',
            'account_status' =>  'true',
            'role_type_id' => 1,
            'email_verified_at' => now(),
            'remember_token' => 1
        ]);

        User::factory(2)->create();
        Person::factory(2)->create();
        EstablishmentType::factory(5)->create();
        Establishment::factory(1)->create();
        Category::factory(10)->create();
        Brand::factory(10)->create();
        Product::factory(50)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
