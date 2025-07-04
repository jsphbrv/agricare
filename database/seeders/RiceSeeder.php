<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RiceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rice')->insertOrIgnore([
            ['name' => 'NSIC Rc222'],
            ['name' => 'NSIC Rc160'],
            ['name' => 'NSIC Rc216'],
            ['name' => 'PSB Rc82'],
            ['name' => 'PSB Rc18'],
            ['name' => 'Mestizo 1'],
            ['name' => 'Mestiso 20'],
            ['name' => 'SL-8H'],
            ['name' => 'Bigante Plus'],
        ]);
    }
}
