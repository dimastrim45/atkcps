<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class MinimumQtyReportExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection, WithHeadings
    */
    public function collection()
    {
        //
        return Item::select('items.name', 'items.itemgroup_id', 'items.uom', 'items.price', 'items.expdate', 'items.min_qty', 'items.qty', 'items.status')
        ->get();
    }

    public function headings(): array
    {
        return [
            'Item Name',
            'Item Group',
            'UoM',
            'Price',
            'Exp Date',
            'Min. Qty',
            'Qty',
            'Status',
        ];
    }
}
