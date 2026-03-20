<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            UsersSeeder::class,
            CategoriesSeeder::class,
            WarehousesSeeder::class,
            MovementTypesSeeder::class,
            MovementReasonsSeeder::class,
            ProductsSeeder::class,
            MovementsSeeder::class,
            AlertsSeeder::class,
            AlertActionSeeder::class,
        ]);
    }

    
}
