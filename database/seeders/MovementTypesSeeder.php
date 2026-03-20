<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovementTypesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('movement_types')->delete();
 // MUY IMPORTANTE

        DB::table('movement_types')->insert([
            [
                'name' => 'Entrada',
                'description' => 'Entrada de productos',
            ],
            [
                'name' => 'Salida',
                'description' => 'Salida de productos',
            ],
            [
                'name' => 'Ajuste',
                'description' => 'Corrección de stock',
            ],
        ]);
    }
}
