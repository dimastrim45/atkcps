<?php

namespace App\Exports;

use App\Models\MovingAverage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class MovingAvgByItemReportExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection, WithHeadings
    */
    public function collection()
    {
        // Retrieve the item ID from the form data
        $itemId = request()->input('itemId');

        return MovingAverage::select(
            'items.name as Item Name',
            'qtyIn as Qty In',
            'totalIn as Total In',
            'DocTypeIn as Doctype In',
            'DocNumIn as Docnum In',
            'qtyOut as Qty Out',
            'totalOut as Total Out',
            'DocTypeOut as Doctype Out',
            'DocNumOut as Docnum Out',
            'qtySaldo as Qty Saldo',
            'totalSaldo as Total Saldo',
            'docdate as Date',
            \DB::raw("DATE_FORMAT(moving_averages.created_at, '%H:%i:%s') as Time") // Add this line for time
        )
        ->leftJoin('items', 'moving_averages.itemSaldo_id', '=', 'items.id')
        ->where('itemSaldo_id', $itemId) // Add this line for the condition
        ->orderBy('itemSaldo_id')
        ->get();
    }

    public function headings(): array
    {
        return [
            'Item Name',
            'Qty In',
            'Total In',
            'Doctype In',
            'Docnum In',
            'Qty Out',
            'Total Out',
            'Doctype Out',
            'Docnum Out',
            'Qty Saldo',
            'Total Saldo',
            'Date',
            'Time', // Add this line for the new "Time" heading
        ];
    }
}
