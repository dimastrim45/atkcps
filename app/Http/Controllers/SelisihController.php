<?php

namespace App\Http\Controllers;

use App\Models\Selisih;
use App\Models\Item;
use App\Http\Requests\StoreSelisihRequest;
use App\Http\Requests\UpdateSelisihRequest;
use Carbon\Carbon;

class SelisihController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Route::view('selisihs', 'it_admin.selisih-index', ['title' => 'selisihs'])->name('selisihs');
        // $selisihs = $selisihs = Selisih::whereIn('id', function($query) {
        //     $query->selectRaw('MIN(id)')
        //         ->from('selisihs')
        //         ->groupBy('docnum');
        // })->paginate(20);
        
        return view('it_admin.selisih-index', [
            'title' => 'selisihs',
            // 'selisihs' => $selisihs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retrieve all items with an "Active" status
        $items = Item::where('status', 'active')->get();

        // Load the 'it_admin.barang-masuk-add' view with the filtered items
        return view('it_admin.selisih-add', [
            'title' => 'selisihadd',
            "items" => $items,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSelisihRequest $request)
    {
        //
        // dd($request);

        // Get the current year and month
        $currentYear = date('Y');
        $currentMonth = date('m');

        // Determine the next available ID for the current month
        $nextID = Selisih::whereYear('created_at', '=', $currentYear)
            ->whereMonth('created_at', '=', $currentMonth)
            ->max('id') + 1;

        // Format the next ID as a three-digit string (e.g., 001)
        $formattedID = str_pad($nextID, 3, '0', STR_PAD_LEFT);

        // Loop through the items and insert them into the "barang_masuks" table
        $itemIds = $request->input('item_id');
        $qtys = $request->input('qty');

        foreach ($itemIds as $key => $itemId) {
            // Create a new instance of the selisih model for each item
            $selisih = new Selisih();
            $selisih->docnum = $currentYear . $currentMonth . $formattedID;
            // Convert the docdate to the desired format (dd-mm-yyyy)
            $currentDate = Carbon::now()->format('Y-m-d');
            $selisih->docdate = $currentDate;
            $selisih->remarks = $request->input('remarks');
            $selisih->admin = auth()->user()->name; // Assuming you're storing the admin's name

            // Set the item-specific data
            $selisih->item_id = $itemId;
            $selisih->qty = $qtys[$key];

            // Save the current item to the database
            $selisih->save();

            // Update the corresponding item in the "Item" table:
            // - Increment the quantity ("qty") by the quantity of the new "selisih."
            // - Update the expiration date ("expdate") with the new value.
            // - Calculate and set the average price by averaging the existing price and the new price.
            // - Save the changes to the "Item" model in the database.
            $item = Item::find($itemId);
            if ($item) {
                // Add the added quantity to the current "qty"
                $item->qty = $qtys[$key];
                $item->save();
            }
        }

        // Redirect back or to a success page
        return redirect()->route('selisihs');
    }

    /**
     * Display the specified resource.
     */
    public function show(Selisih $selisih)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Selisih $selisih)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSelisihRequest $request, Selisih $selisih)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Selisih $selisih)
    {
        //
    }
}
