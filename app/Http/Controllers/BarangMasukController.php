<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Item;
use App\Http\Requests\StoreBarangMasukRequest;
use App\Http\Requests\UpdateBarangMasukRequest;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangmasuks = $barangmasuks = BarangMasuk::whereIn('id', function($query) {
            $query->selectRaw('MIN(id)')
                ->from('barang_masuks')
                ->groupBy('docnum');
        })->paginate(20);
        
        return view('it_admin.barang-masuk-index', [
            'title' => 'barangmasuks',
            'barangmasuks' => $barangmasuks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Route::view('barangmasukadd', 'it_admin.barang-masuk-add', ['title' => 'barangmasukadd'])->name('barangmasukadd');
        $items = Item::all();
        return view('it_admin.barang-masuk-add', [
            'title' => 'barangmasukadd',
            "items" => $items,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBarangMasukRequest $request)
    {
        // Get the current year and month
        $currentYear = date('Y');
        $currentMonth = date('m');

        // Determine the next available ID for the current month
        $nextID = BarangMasuk::whereYear('created_at', '=', $currentYear)
            ->whereMonth('created_at', '=', $currentMonth)
            ->max('id') + 1;

        // Format the next ID as a three-digit string (e.g., 001)
        $formattedID = str_pad($nextID, 3, '0', STR_PAD_LEFT);

        // Loop through the items and insert them into the "barang_masuks" table
        $itemIds = $request->input('item_id');
        $prices = $request->input('price');
        $expDates = $request->input('expdate');
        $qtys = $request->input('qty');

        foreach ($itemIds as $key => $itemId) {
            // Create a new instance of the BarangMasuk model for each item
            $barangMasuk = new BarangMasuk();
            $barangMasuk->docnum = $currentYear . $currentMonth . $formattedID;
            // Convert the docdate to the desired format (dd-mm-yyyy)
            $currentDate = Carbon::now()->format('Y-m-d');
            $barangMasuk->docdate = $currentDate;
            $barangMasuk->remarks = $request->input('remarks');
            $barangMasuk->admin = auth()->user()->name; // Assuming you're storing the admin's name
            $barangMasuk->po_docnum = $request->input('nomorpo'); // You may need to adjust this field

            // Set the item-specific data
            $barangMasuk->item_id = $itemId;
            $barangMasuk->qty = $qtys[$key];
            $barangMasuk->expdate = $expDates[$key];
            $barangMasuk->price = $prices[$key];

            // Save the current item to the database
            $barangMasuk->save();

            // Update the field in the "Item" table
            $item = Item::find($itemId);
            if ($item) {
                // Add the added quantity to the current "qty"
                $item->qty += $qtys[$key];
                $item->expdate = $expDates[$key];
                $averagePrice = ($item->price + $prices[$key]) / 2;
                $item->price = $averagePrice;
                $item->save();
            }
        }

        // Redirect back or to a success page
        return redirect()->route('barangmasuks');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangMasuk $barangmasuk)
    {
        $barangmasukdoc = BarangMasuk::where('docnum', $barangmasuk->docnum)->get();

        return view('it_admin.barang-masuk-show', [
                    'title' => 'barangmasuk-show',
                    'barangmasuks' => $barangmasukdoc,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBarangMasukRequest $request, BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangMasuk $barangMasuk)
    {
        //
    }
}
