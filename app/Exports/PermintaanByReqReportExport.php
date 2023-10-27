<?php

namespace App\Exports;

use App\Models\Permintaan;
use App\Models\User;
use Illuminate\Http\Request; // Import the Request class
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PermintaanByReqReportExport implements FromCollection, WithHeadings
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
        $permintaans = Permintaan::where('user_id', $this->requester_id)->get();

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
