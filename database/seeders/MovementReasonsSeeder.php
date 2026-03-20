<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovementReasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movement_reasons')->insert([
    ['name' => 'Compra', 'affects_stock' => 'suma', 'description' => 'Compra a proveedor'],
    ['name' => 'Venta', 'affects_stock' => 'resta', 'description' => 'Venta a cliente'],
    ['name' => 'Daño', 'affects_stock' => 'resta', 'description' => 'Producto dañado'],
]);

    }
}
