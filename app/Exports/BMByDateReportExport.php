<?php

namespace App\Exports;

use App\Models\BarangMasuk;
use Illuminate\Http\Request; // Import the Request class
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BMByDateReportExport implements FromCollection, WithHeadings
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
        $barangMasuks = BarangMasuk::whereBetween('docdate', [$this->fromDate, $this->toDate])->get();

        // Modify the data structure to include the desired columns
        $data = $barangMasuks->map(function ($barangMasuk) {
            return [
                $barangMasuk->docnum,
                $barangMasuk->docdate,
                $barangMasuk->item->name,
                $barangMasuk->item->expdate,
                $barangMasuk->qty,
                $barangMasuk->item->price,
                $barangMasuk->subtotal,
                $barangMasuk->po_docnum,
                $barangMasuk->remarks,
                $barangMasuk->status,
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        return [
            'Document Number',
            'Document Date',
            'Item Name',
            'Exp Date',
            'Qty',
            'Price',
            'Subtotal',
            'PO Docnum',
            'Remarks',
            'Status'
        ];
    }
}
