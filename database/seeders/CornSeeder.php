<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CornSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('corns')->insertOrIgnore([
            ['name' => 'IPB Var 6'],
            ['name' => 'IPB Var 8'],
            ['name' => 'Super White'],
            ['name' => 'DK6919S'],
            ['name' => 'NK6410'],
            ['name' => 'Pioneer P30T17'],
            ['name' => 'Bioseed 9909'],
        ]);
    }
}
