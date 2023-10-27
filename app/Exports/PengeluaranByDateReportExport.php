<?php

namespace App\Exports;

use App\Models\Pengeluaran;
use Illuminate\Http\Request; // Import the Request class
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengeluaranByDateReportExport implements FromCollection, WithHeadings
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
        $pengeluarans = Pengeluaran::whereBetween('docdate', [$this->fromDate, $this->toDate])->get();

        // Modify the data structure to include the desired columns
        $data = $pengeluarans->map(function ($pengeluaran) {
            return [
                $pengeluaran->docnum,
                $pengeluaran->docdate,
                $pengeluaran->admin,
                $pengeluaran->requester_name,
                $pengeluaran->requester->plant->name,
                $pengeluaran->item->name,
                $pengeluaran->item->expdate,
                $pengeluaran->qty,
                $pengeluaran->item->price,
                $pengeluaran->remarks,
                $pengeluaran->status,
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        return [
            'Document Number',
            'Document Date',
            'Admin',
            'Requester',
            'Branch',
            'Item Name',
            'Exp Date',
            'Qty',
            'Price',
            'Remarks',
            'Status'
        ];
    }
}
