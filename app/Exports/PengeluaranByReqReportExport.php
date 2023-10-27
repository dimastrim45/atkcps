<?php

namespace App\Exports;

use App\Models\Pengeluaran;
use App\Models\User;
use Illuminate\Http\Request; // Import the Request class
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengeluaranByReqReportExport implements FromCollection, WithHeadings
{
    protected $requester_id;

    public function __construct(Request $request)
    {
        // Get the requester values from the request
        $this->requester_id = $request->input('requester_id');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $requester = User::where('id', $this->requester_id)->first();
        /// Query the Permintaan model to retrieve data where user_id matches requester
        $pengeluarans = Pengeluaran::where('requester_id', $this->requester_id)->get();

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
