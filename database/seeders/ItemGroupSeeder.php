<?php

namespace Database\Seeders;
//
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $itemgroups = [
            [
                'name' => 'Alat Tulis Kantor',
                'code' => 'ATK',
                'isENG' => true,
                'isFAT' => true,
                'isWFG' => true,
                'isWRT' => true,
                'isWRM' => true,
                'isHRG' => true,
                'isDGS' => true,
                'isSLS' => true,
                'isMKT' => true,
                'isDEL' => true,
                'isPRD' => true,
                'isPPI' => true,
                'isRPR' => true,
                'isPCH' => true,
                'isQCT' => true,
            ],
            [
                'name' => 'Obat - Obatan',
                'code' => 'OBT',
                'isENG' => true,
                'isFAT' => true,
                'isWFG' => true,
                'isWRT' => true,
                'isWRM' => true,
                'isHRG' => true,
                'isDGS' => true,
                'isSLS' => true,
                'isMKT' => true,
                'isDEL' => true,
                'isPRD' => true,
                'isPPI' => true,
                'isRPR' => true,
                'isPCH' => true,
                'isQCT' => true,
            ],
            [
                'name' => 'Rumah Tangga Umum',
                'code' => 'RTU',
                'isENG' => true,
                'isFAT' => true,
                'isWFG' => true,
                'isWRT' => true,
                'isWRM' => true,
                'isHRG' => true,
                'isDGS' => true,
                'isSLS' => true,
                'isMKT' => true,
                'isDEL' => true,
                'isPRD' => true,
                'isPPI' => true,
                'isRPR' => true,
                'isPCH' => true,
                'isQCT' => true,
            ],
            [
                'name' => 'Rumah Tangga Khusus',
                'code' => 'RTK',
                'isENG' => false,
                'isFAT' => false,
                'isWFG' => false,
                'isWRT' => false,
                'isWRM' => false,
                'isHRG' => true,
                'isDGS' => false,
                'isSLS' => false,
                'isMKT' => false,
                'isDEL' => false,
                'isPRD' => false,
                'isPPI' => false,
                'isRPR' => false,
                'isPCH' => false,
                'isQCT' => false,
            ],
        ];
        \DB::table('item_groups')->insert($itemgroups);
    }
}
