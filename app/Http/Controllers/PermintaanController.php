<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use App\Models\Item;
use App\Http\Requests\StorePermintaanRequest;
use App\Http\Requests\UpdatePermintaanRequest;
use Carbon\Carbon;

class PermintaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permintaans = $permintaans = Permintaan::whereIn('id', function($query) {
            $query->selectRaw('MIN(id)')
                ->from('permintaans')
                ->groupBy('docnum');
        })->paginate(20);

        return view('it_admin.permintaan-index', [
            'title' => 'permintaans',
            'permintaans' => $permintaans,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::all();
        return view('it_admin.permintaan-add', [
            'title' => 'addpermintaan',
            "items" => $items,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermintaanRequest $request)
    {
        //
        // dd($request);
        // Get the current year and month
        $currentYear = date('Y');
        $currentMonth = date('m');

        // Determine the next available ID for the current month
        $nextID = Permintaan::whereYear('created_at', '=', $currentYear)
            ->whereMonth('created_at', '=', $currentMonth)
            ->max('id') + 1;

        // Format the next ID as a three-digit string (e.g., 001)
        $formattedID = str_pad($nextID, 3, '0', STR_PAD_LEFT);
        // dd($formattedID);

        // Loop through the items and insert them into the "barang_masuks" table
        $itemIds = $request->input('item_id');
        $prices = $request->input('price');
        $expDates = $request->input('expdate');
        $qtys = $request->input('qty');

        foreach ($itemIds as $key => $itemId) {
            // Create a new instance of the permin$permintaan model for each item
            $permintaan = new Permintaan();
            $permintaan->docnum = $currentYear . $currentMonth . $formattedID;
            // Convert the docdate to the desired format (dd-mm-yyyy)
            $currentDate = Carbon::now()->format('Y-m-d');
            $permintaan->docdate = $currentDate;
            $permintaan->duedate = $request->input('duedate');
            $permintaan->user_id = auth()->id();
            $permintaan->status = "Open";
            $permintaan->remarks = $request->input('remarks');
            $permintaan->admin = auth()->user()->name; // Assuming you're storing the admin's name

            // Set the item-specific data
            $permintaan->item_id = $itemId;
            $permintaan->qty = $qtys[$key];
            $permintaan->expdate = $expDates[$key];
            $permintaan->price = $prices[$key];

            // Save the current item to the database
            $permintaan->save();
        }

        // Redirect back or to a success page
        return redirect()->route('permintaans');
    }

    /**
     * Display the specified resource.
     */
    public function show(Permintaan $permintaan)
    {
        //
        // dd($permintaan->docnum);
        $permintaandoc = Permintaan::where('docnum', $permintaan->docnum)->get();

        return view('it_admin.permintaan-show', [
                    'title' => 'permintaan-show',
                    'permintaans' => $permintaandoc,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permintaan $permintaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermintaanRequest $request, Permintaan $permintaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permintaan $permintaan)
    {
        //
    }
}
