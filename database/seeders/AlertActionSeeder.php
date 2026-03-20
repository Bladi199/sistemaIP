<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AlertActionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('alert_actions')->insert([
            [
                'alert_id' => 1,
                'user_id' => 1,
                'action' => 'resolver',
                'created_at' => Carbon::now(),
            ],
            [
                'alert_id' => 2,
                'user_id' => 1,
                'action' => 'ignorar',
                'created_at' => Carbon::now(),
            ],
            [
                'alert_id' => 1,
                'user_id' => 1,
                'action' => 'resolver',
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}

