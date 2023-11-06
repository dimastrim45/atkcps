<?php

namespace App\Exports;

use App\Models\MovingAverage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class MovingAvgReportExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection, WithHeadings
    */
    public function collection()
    {
        //
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
            'docdate as Date'
        )
        ->leftJoin('items', 'moving_averages.itemSaldo_id', '=', 'items.id')
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
        ];
    }
}
