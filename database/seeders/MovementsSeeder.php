<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movements')->insert([
    [
        'product_id' => 1,
        'user_id' => 1,
        'movement_type_id' => 1,
        'movement_reason_id' => 1,
        'quantity' => 50,
        'notes' => 'Ingreso inicial',
        'created_at' => now(),
    ],
]);

    }
}
