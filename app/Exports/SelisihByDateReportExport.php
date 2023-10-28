<?php

namespace App\Exports;

use App\Models\Selisih;
use Illuminate\Http\Request; // Import the Request class
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class SelisihByDateReportExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $fromDate;
    protected $toDate;

    public function __construct(Request $request)
    {
        $this->fromDate = $request->input('fromDate');
        $this->toDate = $request->input('toDate');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Use the date range provided in the constructor
        $selisihs = Selisih::whereBetween('docdate', [$this->fromDate, $this->toDate])->get();

        // Modify the data structure to include the desired columns
        $data = $selisihs->map(function ($selisih) {
            return [
                $selisih->docnum,
                $selisih->status,
                $selisih->admin,
                $selisih->docdate,
                $selisih->item->name,
                $selisih->qty,
                $selisih->remarks,
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        return [
            'Document Number',
            'Status',
            'Admin',
            'Document Date',
            'Item Name',
            'Qty',
            'Remarks',
        ];
    }
}
