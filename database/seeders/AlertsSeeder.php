<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AlertsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('alerts')->insert([
    [
        'product_id' => 1,
        'type' => 'bajo',
        'severity' => 'media',
        'message' => 'El stock del producto está por debajo del mínimo.',
        'status' => 'activa',
        'resolved_at' => null,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ],
    [
        'product_id' => 2,
        'type' => 'critico',
        'severity' => 'alta',
        'message' => 'Stock crítico, reabastecer inmediatamente.',
        'status' => 'resuelta',
        'resolved_at' => Carbon::now(),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ],
    [
        'product_id' => 2,
        'type' => 'agotado',
        'severity' => 'alta',
        'message' => 'Producto agotado en almacén.',
        'status' => 'activa',
        'resolved_at' => null,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ],
]);

    }
}

