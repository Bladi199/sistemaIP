<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
    ['name' => 'Viguetas', 'description' => 'Viguetas pretensadas'],
    ['name' => 'Plastoformos', 'description' => 'Bloques alivianados'],
    ['name' => 'Accesorios', 'description' => 'Material complementario'],
]);

    }
}
