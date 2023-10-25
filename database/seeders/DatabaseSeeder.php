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
        RoleType::factory(3)->create();
        DocumentType::factory(2)->create();
        User::factory(3)->create();
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
