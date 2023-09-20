<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Permintaan;
use App\Models\Item;
use Carbon\Carbon;
use App\Http\Requests\StorePengeluaranRequest;
use App\Http\Requests\UpdatePengeluaranRequest;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $permintaans = $permintaans = Permintaan::whereIn('id', function($query) {
        //     $query->selectRaw('MIN(id)')
        //         ->from('permintaans')
        //         ->groupBy('docnum');
        // })->paginate(20);

        return view('it_admin.pengeluaran-index', [
            'title' => 'pengeluarans',
            // 'permintaans' => $permintaans,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $permintaanDocnum = $request->input('permintaan_docnum');

        // Retrieve all Permintaan records where docnum matches $permintaanDocnum
        $permintaans = Permintaan::where('docnum', $permintaanDocnum)->get();

        // dd($permintaans);

        if ($permintaans->isEmpty()) {
            // Handle the case where no matching Permintaan records were found.
            // You might want to display an error message or perform other actions.
            return redirect()->back()->with('error', 'No Permintaan records found for the given docnum.');
        }

        return view('it_admin.pengeluaran-add', [
            'title' => 'pengeluaranadd',
            'permintaans' => $permintaans, // Pass the Permintaan collection to the view
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePengeluaranRequest $request)
    {
        // dd($request);
        //
        $currentYear = date('Y');
        $currentMonth = date('m');

        // Determine the next available ID for the current month
        $nextID = Pengeluaran::whereYear('created_at', '=', $currentYear)
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
            // Retrieve the item based on the current $itemId
            $item = Item::find($itemId);
    
            if ($item) {
                // Create a new instance of the pengeluaran model for each item
                $pengeluaran = new Pengeluaran();
                $pengeluaran->docnum = $currentYear . $currentMonth . $formattedID;
                // Convert the docdate to the desired format (dd-mm-yyyy)
                $currentDate = Carbon::now()->format('Y-m-d');
                $pengeluaran->docdate = $currentDate;
                // $pengeluaran->duedate = $request->input('duedate');
                $pengeluaran->permintaan_id = $request->input('permintaan_id');
                $pengeluaran->user_id = auth()->id();
                $pengeluaran->admin = auth()->user()->name;
                $pengeluaran->status = "Open";
                $pengeluaran->remarks = $request->input('remarks');
                $pengeluaran->requester = $request->input('requester'); // Assuming you're storing the requester's name
    
                // Set the item-specific data
                $pengeluaran->item_id = $itemId;
                $pengeluaran->qty = $qtys[$key];
                $pengeluaran->expdate = $expDates[$key];
                $pengeluaran->price = $prices[$key];
    
                // Save the current item to the database
                $pengeluaran->save();
    
                // Update the open item quantity in Permintaan
                $permintaan = Permintaan::where('item_id', $itemId)->first(); // Assuming there's a relationship between Permintaan and Item
                if ($permintaan && $permintaan->openqty - $qtys[$key] >= 0) {
                    $permintaan->openqty -= $qtys[$key];
                    $permintaan->save();
                } else {
                    // Handle the case where subtracting the quantity would be negative or no corresponding Permintaan record is found
                    // You can add an error message or redirect with a message
                    return redirect()->back()->withErrors(['error' => 'Insufficient open quantity for the selected item.']);
                }
            } else {
                // Handle the case where the item is not found
                // You can add an error message or redirect with a message
                return redirect()->back()->withErrors(['error' => 'Item not found.']);
            }
        }

        // Redirect back or to a success page
        return redirect()->route('pengeluarans');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePengeluaranRequest $request, Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
        //
    }
}
