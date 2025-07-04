<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PestsTableSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

    $this->call([
         PesticideSeeder::class,
        PestsTableSeeder::class,
        RiceSeeder::class,
        CornSeeder::class,
    ]);


       User::factory()->create([
    'first_name'     => 'Test',
    'last_name'      => 'User',
    'gender'         => 'Male', // or 'Female'
    'address'        => 'Poblacion East',
    'mobile_number'  => '09171334590', // ✅ correct column
    //'email'          => null, // or a real email if required
    'password'       => bcrypt('password'), // hashed password
    'role'           => 'farmer', // or 'admin' or any role
    'status'         => 'Active',
]);

    }
}
