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
        $pengeluarans = $pengeluarans = Pengeluaran::whereIn('id', function($query) {
            $query->selectRaw('MIN(id)')
                ->from('pengeluarans')
                ->groupBy('docnum');
        })->paginate(20);

        return view('it_admin.pengeluaran-index', [
            'title' => 'pengeluarans',
            'pengeluarans' => $pengeluarans,
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

        // Check if any Permintaan has the 'Rejected' status
        if ($permintaans->contains('status', 'Rejected')) {
            return redirect()->back()->with('error', 'Permintaan is rejected.');
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
        // Get the current year and month
        $currentYear = date('Y');
        $currentMonth = date('m');
    
        // Determine the next available ID for the current month
        $nextID = Pengeluaran::whereYear('created_at', '=', $currentYear)
            ->whereMonth('created_at', '=', $currentMonth)
            ->max('id') + 1;
    
        // Format the next ID as a three-digit string (e.g., 001)
        $formattedID = str_pad($nextID, 3, '0', STR_PAD_LEFT);
    
        // Fetch the Permintaan record once outside the loop
        $permintaan = Permintaan::find($request->input('permintaan_id'));
    
        // Check if the Permintaan record exists
        if (!$permintaan) {
            return redirect()->back()->withErrors(['error' => 'Permintaan record not found.']);
        }
    
        // Define an array to store the data for updating openqty
        $openQtyUpdates = [];
    
        // Loop through the items and validate them
        $itemIds = $request->input('item_id');
        $prices = $request->input('price');
        $expDates = $request->input('expdate');
        $qtys = $request->input('qty');
    
        // Define a flag to track if all items are valid
        $allItemsValid = true;
    
        foreach ($itemIds as $key => $itemId) {
            // Retrieve the item based on the current $itemId
            $item = Item::find($itemId);
    
            if ($item) {
                // Calculate the available openqty for this permintaan item
                $openQty = $permintaan->openqty;
    
                if ($openQty - $qtys[$key] >= 0) {
                    // Continue validating other items
                } else {
                    // Set the flag to false if any item is not valid
                    $allItemsValid = false;
                    break; // Exit the loop immediately
                }
    
                // Prepare data for updating openqty after saving the pengeluaran
                $openQtyUpdates[$itemId] = $qtys[$key];
            } else {
                // Handle the case where the item is not found
                $allItemsValid = false;
                break; // Exit the loop immediately
            }
        }
    
        // Check if all items are valid before saving any data
        if ($allItemsValid) {
            // Save all items to the database
            foreach ($itemIds as $key => $itemId) {
                // Retrieve the item based on the current $itemId
                $item = Item::find($itemId);
                // Create a new instance of the Pengeluaran model for each item
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
            }

            // Update the Permintaan's open quantity for each item
            foreach ($itemIds as $key => $itemId) {
                // Retrieve the associated Permintaan record for the item
                $associatedPermintaan = Permintaan::where('docnum', $request->input('permintaan_docnum'))
                    ->where('item_id', $itemId)
                    ->first();

                if ($associatedPermintaan) {
                    $associatedPermintaan->update(['openqty' => $associatedPermintaan->openqty - $qtys[$key]]);
                }
            }
        
            // Redirect back or to a success page after all items are saved
            return redirect()->route('pengeluarans');
        } else {
            // Handle the case where at least one item is not valid
            // You can add an error message or redirect with a message
            return redirect()->back()->withErrors(['error' => 'At least one item has insufficient quantity.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengeluaran $pengeluaran)
    {
        //
        $pengeluarandoc = Pengeluaran::where('docnum', $pengeluaran->docnum)->get();

        return view('it_admin.pengeluaran-show', [
                    'title' => 'pengeluaran-show',
                    'pengeluarans' => $pengeluarandoc,
        ]);
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
