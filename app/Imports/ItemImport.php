<?php

namespace App\Imports;

use App\Models\Item;
use App\Models\MovingAverage;
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

        // Assuming you have the item_id available (you may need to adjust this part)
        $item = new Item([
            'itemgroup_id' => $row[0],
            'name' => $row[1],
            'uom' => $row[2],
            'price' => $row[3],
            'expdate' => $row[4],
            'qty' => $row[5],
            'min_qty' => $row[6],
            'status' => $row[7],
        ]);

        // Save the item
        $item->save();

        // Create and save the MovingAverage entry
        $movingAverage = new MovingAverage();
        $movingAverage->itemIn_id = $item->id; // Assuming the item_id is the id of the newly saved item
        $movingAverage->qtyIn = $row[5]; // Assuming qty is at index 5
        $movingAverage->totalIn = $row[3] * $row[5]; // Assuming price is at index 3 and qty is at index 5
        $movingAverage->DocTypeIn = 'Saldo Awal';
        $movingAverage->DocNumIn = 'Import';
        $movingAverage->itemSaldo_id = $item->id; // Assuming the item_id is the id of the newly saved item
        $movingAverage->qtySaldo = $row[5]; // Assuming qty is at index 5
        $movingAverage->totalSaldo = $row[3] * $row[5]; // Assuming price is at index 3 and qty is at index 5
        $movingAverage->docdate = now(); // Assuming you want to use the current date and time
        $movingAverage->save();

        // Return the newly created item
        return $item;
    }
}
