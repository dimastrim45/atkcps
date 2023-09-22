<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plants = [
            [
                'code' => 'PL001',
                'name' => 'Plant 1',
                'city' => 'City 1',
                'province' => 'Province 1',
                'address' => '123 Main St',
                'status' => 'Active',
            ],
            [
                'code' => 'PL002',
                'name' => 'Plant 2',
                'city' => 'City 2',
                'province' => 'Province 2',
                'address' => '456 Elm St',
                'status' => 'Active',
            ],
            [
                'code' => 'PL003',
                'name' => 'Plant 3',
                'city' => 'City 3',
                'province' => 'Province 3',
                'address' => '456 Elm St',
                'status' => 'Active',
            ],
            [
                'code' => 'PL004',
                'name' => 'Plant 4',
                'city' => 'City 4',
                'province' => 'Province 4',
                'address' => '456 Elm St',
                'status' => 'Active',
            ],
            [
                'code' => 'PL005',
                'name' => 'Plant 5',
                'city' => 'City 5',
                'province' => 'Province 5',
                'address' => '456 Elm St',
                'status' => 'Active',
            ],
            // Add more plant data as needed
        ];
        \DB::table('plants')->insert($plants);
    }
}
