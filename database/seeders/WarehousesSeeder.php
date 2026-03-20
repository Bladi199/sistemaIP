<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehousesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('warehouses')->insert([
    ['name' => 'Almacén Central', 'description' => 'Principal', 'ubicacion' => 'Planta PRETENFORT'],
    ['name' => 'Sucursal Sur', 'description' => 'Zona Sur', 'ubicacion' => 'La Paz'],
    ['name' => 'Sucursal Norte', 'description' => 'Zona Norte', 'ubicacion' => 'El Alto'],
]);

    }
}
