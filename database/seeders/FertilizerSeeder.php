<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FertilizerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fertilizers')->insert([
    ['name' => 'Fertilizer A', 'description' => 'Used for rice '],
    ['name' => 'Fertilizer B', 'description' => 'Used for corn '],
]);

    }
}
