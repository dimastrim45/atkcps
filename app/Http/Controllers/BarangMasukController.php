<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Item;
use Illuminate\Http\Request;
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
     * Create a new Permintaan (Request) for a Barang (Item).
     *
     * This method retrieves all items with an "Active" status from the database
     * and passes them to the 'it_admin.barang-masuk-add' view for creating a new Permintaan.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Retrieve all items with an "Active" status
        $items = Item::where('status', 'active')->get();

        // Load the 'it_admin.barang-masuk-add' view with the filtered items
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

        $latestBarangMasuk = BarangMasuk::orderBy('created_at', 'desc')->first();

        if ($latestBarangMasuk) {
            // Extract the current month and year from the created_at timestamp
            $storedMonth = date('m', strtotime($latestBarangMasuk->created_at));
            $storedYear = date('Y', strtotime($latestBarangMasuk->created_at));

            if ($currentYear != $storedYear || $currentMonth != $storedMonth) {
                // If the current month and year are different, reset DocId to 1
                $nextID = 1;
            } else {
                // Increment the maximum DocId within the current month and year by 1
                $nextID = $latestBarangMasuk->DocId + 1;
            }
        } else {
            // If there are no existing records, start with DocId 1
            $nextID = 1;
        }

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
            $barangMasuk->DocId = $nextID;
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

            // Update the corresponding item in the "Item" table:
            // - Increment the quantity ("qty") by the quantity of the new "BarangMasuk."
            // - Update the expiration date ("expdate") with the new value.
            // - Calculate and set the average price by averaging the existing price and the new price.
            // - Save the changes to the "Item" model in the database.
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
        return redirect()->route('barangmasuks')->with('success', 'Barang Masuk Created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangMasuk $barangmasuk)
    {
        $barangmasukdoc = BarangMasuk::where('docnum', $barangmasuk->docnum)->get();

        // Format the date as dd-mm-yyyy using Carbon
        $docDate = Carbon::parse($barangmasukdoc->first()->docdate)->format('d-m-Y');

        return view('it_admin.barang-masuk-show', [
                    'title' => 'barangmasuk-show',
                    'barangmasuks' => $barangmasukdoc,
                    'docDate' => $docDate, // Pass the formatted date to the view
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

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');

            if ($query != '') {
                // Perform a search based on multiple columns
                $barangmasuks = BarangMasuk::where('docnum', 'like', '%' . $query . '%')
                    ->orWhere('admin', 'like', '%' . $query . '%')
                    ->orWhere('remarks', 'like', '%' . $query . '%')
                    ->orWhere('po_docnum', 'like', '%' . $query . '%')
                    ->get();
                // dd($barangmasuks);

                // $barangmasuks = $foundBarangmasuks->groupBy('docnum');
            } else {
                // If the query is empty, retrieve all BarangMasuk and paginate them
                $barangmasuks = BarangMasuk::whereIn('id', function($query) {
                    $query->selectRaw('MIN(id)')
                        ->from('barang_masuks')
                        ->groupBy('docnum');
                })->paginate(20);
            }

            foreach ($barangmasuks as $barangmasuk) {
                // Build the HTML for each row
                $output .= view('it_admin.barang-masuk-row')->with('barangmasuk', $barangmasuk)->render();
            }

            return $output;
        }
    }
}
