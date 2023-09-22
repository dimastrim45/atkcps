<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        // $branches = ['BLB', 'BLI', 'HO', 'JKT', 'KRN', 'MKTSL', 'MWR', 'PGS', 'PROD', 'SMR', 'SPJ', 'TLA', 'WNS'];
        $departments = ['DEL', 'DIST', 'FAT', 'HRGA', 'MGM', 'MKT', 'PPI', 'PRO', 'PUR', 'RETAIL', 'WHS', 'WHSALE'];
        $licenses = ['administrator', 'staff', 'hradmin', 'manager'];

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('Samtri123'), // password
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'plant_id' => random_int(1, 5),
            'department' => $faker->randomElement($departments),
            'license' => $faker->randomElement($licenses), 
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
