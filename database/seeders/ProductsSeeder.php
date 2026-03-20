<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
    [
        'category_id' => 1,
        'warehouse_id' => 1,
        'code' => 'VIG-001',
        'name' => 'Vigueta 12cm',
        'stock_actual' => 100,
        'stock_minimo' => 20,
        'stock_maximo' => 200,
        'precio_unitario' => 45.50,
        'status' => 'activo',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'category_id' => 2,
        'warehouse_id' => 1,
        'code' => 'PLA-001',
        'name' => 'Plastoformo 40x20',
        'stock_actual' => 300,
        'stock_minimo' => 50,
        'stock_maximo' => 500,
        'precio_unitario' => 8.00,
        'status' => 'activo',
        'created_at' => now(),
        'updated_at' => now(),
    ],
]);

    }
}
