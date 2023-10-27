<?php

namespace App\Exports;

use App\Models\Permintaan;
use Illuminate\Http\Request; // Import the Request class
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PermintaanByDateReportExport implements FromCollection, WithHeadings
{
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
        $permintaans = Permintaan::whereBetween('docdate', [$this->fromDate, $this->toDate])->get();

        // Modify the data structure to include the desired columns
        $data = $permintaans->map(function ($permintaan) {
            return [
                $permintaan->docnum,
                $permintaan->requester,
                $permintaan->docdate,
                $permintaan->duedate,
                $permintaan->item->name,
                $permintaan->expdate,
                $permintaan->qty,
                $permintaan->openqty,
                $permintaan->price,
                $permintaan->remarks,
                $permintaan->status,
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        return [
            'Document Number',
            'Requester',
            'Document Date',
            'Due Date',
            'Item Name',
            'Exp Date',
            'Qty',
            'Open Qty',
            'Price',
            'Remarks',
            'Status'
        ];
    }
}
