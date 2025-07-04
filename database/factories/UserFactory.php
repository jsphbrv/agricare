<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
{
    return [
        'first_name'     => $this->faker->firstName(),
        'last_name'      => $this->faker->lastName(),
        'gender'         => $this->faker->randomElement(['Male', 'Female']),
        'address'        => 'Poblacion East', // or use $this->faker->address()
        'mobile_number'  => $this->faker->unique()->phoneNumber(),
       // 'email'          => null, // or $this->faker->unique()->safeEmail() if required
        'password'       => bcrypt('password'),
        'remember_token' => Str::random(10),
        'role'           => 'farmer',
        'status'         => 'Active',
    ];
}


    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
