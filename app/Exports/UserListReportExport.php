<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class UserListReportExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('users.id', 'users.name', 'users.email', 'users.plant_id','plants.name as plant_name', 'users.department', 'users.license')
            ->leftJoin('plants', 'users.plant_id', '=', 'plants.id')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Plant ID',
            'Plant Name', // Add 'Plant Name' to the headings
            'Department',
            'License',
        ];
    }
}
