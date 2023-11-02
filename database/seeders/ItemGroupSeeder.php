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
            'isGFG' => true,
            'isGRT' => true,
            'isGRM' => true,
            'isHRGA' => true,
            'isDGSL' => true,
            'isSLS' => true,
            'isMRKT' => true,
            'isDEL' => true,
            'isPROD' => true,
            'isPPIC' => true,
            'isRPR' => true,
            'isPRCH' => true,
            ],
            [
            'name' => 'Obat - Obatan',
            'code' => 'OB',
            'isENG' => false,
            'isFAT' => false,
            'isGFG' => false,
            'isGRT' => false,
            'isGRM' => false,
            'isHRGA' => true,
            'isDGSL' => false,
            'isSLS' => false,
            'isMRKT' => false,
            'isDEL' => false,
            'isPROD' => false,
            'isPPIC' => false,
            'isRPR' => false,
            'isPRCH' => false,
            ],
            [
            'name' => 'Rumah Tangga',
            'code' => 'RT',
            'isENG' => false,
            'isFAT' => false,
            'isGFG' => false,
            'isGRT' => false,
            'isGRM' => false,
            'isHRGA' => true,
            'isDGSL' => false,
            'isSLS' => false,
            'isMRKT' => false,
            'isDEL' => false,
            'isPROD' => false,
            'isPPIC' => false,
            'isRPR' => false,
            'isPRCH' => false,
            ],
        ];
        \DB::table('item_groups')->insert($itemgroups);
    }
}
