<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
                    [
                        'name' => 'Sam Martin',
                        'email' => 'sammartintm45@gmail.com',
                        'email_verified_at' => now(),
                        'password' => Hash::make('Samtri123'), // password
                        'remember_token' => Str::random(10),
                        'plant_id' => 1,
                        'department' => 'FAT',
                        'license' => 'administrator', 
                    ],
                    // Add more plant data as needed
                ];
                \DB::table('users')->insert($users);
    }
}
