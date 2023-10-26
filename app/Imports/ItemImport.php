<?php

namespace App\Imports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\ToModel;

class ItemImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // $expdate = $row[4];

        // // Convert 'MM/DD/YYYY' to 'YYYY-MM-DD'
        // $expdate = \DateTime::createFromFormat('m/d/Y', $expdate)->format('Y-m-d');

        return new Item([
            'itemgroup_id' => $row[0],
            'name' => $row[1],
            'uom' => $row[2],
            'price' => $row[3],
            'expdate' => $row[4],
            'qty' => $row[5],
            'min_qty' => $row[6],
            'status' => $row[7],
        ]);
    }
}
