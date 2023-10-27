<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ItemListReportExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::select('id', 'name', 'email', 'plant_id', 'department', 'license')
            ->with('plant:id,name') // Eager load the 'plant' relationship
            ->get()
            ->map(function ($user) {
                return [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->plant_id,
                    $user->plant->name, // Access the 'Plant Name' through the relationship
                    $user->department,
                    $user->license,
                ];
            });
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
