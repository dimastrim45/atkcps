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
                'code' => 'WNR',
                'name' => 'Wonosari',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
                'address' => 'Jl. Wonosari Kidul No. 137',
                'status' => 'Active',
            ],
            [
                'code' => 'MWR',
                'name' => 'Mawar',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
                'address' => 'Jl. Mawar No. 52',
                'status' => 'Active',
            ],
            [
                'code' => 'SPJ',
                'name' => 'Sepanjang',
                'city' => 'Sidoarjo',
                'province' => 'Jawa Timur',
                'address' => 'Jl. Satria Gg. 2',
                'status' => 'Active',
            ],
            [
                'code' => 'KRN',
                'name' => 'Krian',
                'city' => 'Sidoarjo',
                'province' => 'Jawa Timur',
                'address' => 'Jalan Industri Kav.G No.1 Jeruklegi',
                'status' => 'Active',
            ],
            [
                'code' => 'BLB',
                'name' => 'Balongbendo',
                'city' => 'Sidoarjo',
                'province' => 'Jawa Timur',
                'address' => 'Jl. Mayjen Bambang Yuwono',
                'status' => 'Active',
            ],
            [
                'code' => 'KRT',
                'name' => 'Kartini',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
                'address' => 'Jl. RA. Kartini No. 16',
                'status' => 'Active',
            ],
            [
                'code' => 'JKT',
                'name' => 'Kosambi',
                'city' => 'Jakarta',
                'province' => 'DKI Jakarta',
                'address' => 'Pergudangan Kosambi Permai Raya Prancis blok O no 69',
                'status' => 'Active',
            ],
            [
                'code' => 'PGS',
                'name' => 'PGS',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
                'address' => 'PGS Surabaya',
                'status' => 'Active',
            ],
            // Add more plant data as needed
        ];
        \DB::table('plants')->insert($plants);
    }
}
