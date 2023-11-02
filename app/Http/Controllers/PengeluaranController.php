<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Permintaan;
use App\Models\Item;
use App\Models\MovingAverage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\StorePengeluaranRequest;
use App\Http\Requests\UpdatePengeluaranRequest;


class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->license !== 'staff') {
            $pengeluarans = Pengeluaran::whereIn('id', function($query) {
                $query->selectRaw('MIN(id)')
                    ->from('pengeluarans')
                    ->groupBy('docnum');
            })->paginate(20);
        } else {
            $pengeluarans = Pengeluaran::whereIn('id', function($query) use ($user) {
                $query->selectRaw('MIN(id)')
                    ->from('pengeluarans')
                    ->where('requester_id', $user->id)
                    ->groupBy('docnum');
            })->paginate(20);
        }

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

        // dd($pengeluarans);

        if ($permintaans->isEmpty()) {
            // Handle the case where no matching Permintaan records were found.
            // You might want to display an error message or perform other actions.
            return redirect()->back()->with('error', 'No Permintaan records found for the given docnum.');
        }

        // Check if any Permintaan has the 'Rejected' status
        if ($permintaans->contains('status', 'Rejected')) {
            return redirect()->back()->with('error', 'Permintaan is rejected.');
        }

        elseif ($permintaans->contains('status', 'Closed')) {
            return redirect()->back()->with('error', 'Permintaan is closed.');
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
        // Get the current year and month
        $currentYear = date('Y');
        $currentMonth = date('m');
    
        $latestPengeluaran = Pengeluaran::orderBy('created_at', 'desc')->first();

        if ($latestPengeluaran) {
            // Extract the current month and year from the created_at timestamp
            $storedMonth = date('m', strtotime($latestPengeluaran->created_at));
            $storedYear = date('Y', strtotime($latestPengeluaran->created_at));

            if ($currentYear != $storedYear || $currentMonth != $storedMonth) {
                // If the current month and year are different, reset DocId to 1
                $nextID = 1;
            } else {
                // Increment the maximum DocId within the current month and year by 1
                $nextID = $latestPengeluaran->DocId + 1;
            }
        } else {
            // If there are no existing records, start with DocId 1
            $nextID = 1;
        }
    
        // Format the next ID as a three-digit string (e.g., 001)
        $formattedID = str_pad($nextID, 3, '0', STR_PAD_LEFT);
        
        // Loop through the items and validate them
        $itemIds = $request->input('item_id');
        $prices = $request->input('price');
        $expDates = $request->input('expdate');
        $qtys = $request->input('qty');
        $permintaan_id = $request->input('permintaan_id');
    
        // Define a flag to track if all items are valid
        $allItemsValid = true;
        // Define an array to store the data for updating openqty
        $openQtyUpdates = [];
        //to check the openqty comparison
        foreach ($itemIds as $key => $itemId) {
            // validating if item qty in item master data - qty input in pengeluaran cannot exceed qty in item master data
            $item = Item::find($itemId);
            if ($item && $item->qty - $qtys[$key] >= 0) {
                // Continue validating other items
            } else {
                // Set the flag to false if any item is not valid
                $allItemsValid = false;
                break; // Exit the loop immediately
            }
            
            // Get the docnum and quantity for the current item
            $docnum = $request->input('permintaan_docnum');
            $qty = $qtys[$key];
        
            // Calculate the available openqty for this permintaan item
            $openQty = Permintaan::where('docnum', $docnum)
                ->where('item_id', $itemId)
                ->first();
        
            if ($openQty && $openQty->openqty - $qty >= 0) {
                // Continue validating other items
                // Prepare data for updating openqty after saving the pengeluaran
                $openQtyUpdates[$itemId] = $qty;
            } else {
                // Set the flag to false if any item is not valid
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
                $pengeluaran->DocId = $nextID;
                // $pengeluaran->duedate = $request->input('duedate');
                $pengeluaran->user_id = auth()->id();
                $pengeluaran->admin = auth()->user()->name;
                $pengeluaran->status = "Open";
                $pengeluaran->remarks = $request->input('remarks');
                $pengeluaran->requester_id = $request->input('requester_id');
                $pengeluaran->requester_name = $request->input('requester_name'); // Assuming you're storing the requester's name
    
                // Set the item-specific data
                $pengeluaran->item_id = $itemId;
                $pengeluaran->qty = $qtys[$key];
                $pengeluaran->expdate = $expDates[$key];
                $pengeluaran->price = $prices[$key];
                $pengeluaran->permintaan_id = $permintaan_id[$key];
    
                // Save the current item to the database
                $pengeluaran->save();

                // Update the item's quantity
                $item->qty -= $qtys[$key];
                $item->save();

                //below code is updating Moving Average
                $lastMovingAverage = MovingAverage::where('itemSaldo_id', $itemId)
                    ->latest('created_at')
                    ->first();

                if ($lastMovingAverage) {
                    $lastQtySaldo = $lastMovingAverage->qtySaldo;
                    $lastTotalSaldo = $lastMovingAverage->totalSaldo;
                } else {
                    $lastQtySaldo = 0;
                    $lastTotalSaldo = 0;
                }

                $newTotalOut = $qtys[$key]*$prices[$key];

                $movingAverage = new MovingAverage();
                $movingAverage->itemOut_id = $itemId;
                $movingAverage->qtyOut = $qtys[$key];
                $movingAverage->totalOut = $newTotalOut;
                $movingAverage->DocTypeOut = 'Barang Keluar';
                $movingAverage->DocNumOut = $currentYear . $currentMonth . $formattedID;
                $movingAverage->itemSaldo_id = $itemId;
                $movingAverage->qtySaldo = $lastQtySaldo - $qtys[$key];
                $movingAverage->totalSaldo = $lastTotalSaldo - $newTotalOut;
                $movingAverage->docdate = $currentDate;
                $movingAverage->save();
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

            $upOpenQty = Permintaan::where('docnum', $request->input('permintaan_docnum'))
                ->pluck('openqty');

            // Check if all values in $upOpenQty are 0
            if ($upOpenQty->count() > 0 && $upOpenQty->every(function ($value) {
                return $value == 0;
            })) {
                // Update the status to 'Closed'
                Permintaan::where('docnum', $request->input('permintaan_docnum'))
                    ->update(['status' => 'Closed']);
            }

            // dd($permintaanStat);
        
            // Redirect back or to a success page after all items are saved
            return redirect()->route('pengeluarans')->with('success', 'Pengeluaran Barang Created');
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

        // Format the date as dd-mm-yyyy using Carbon
        $docDate = Carbon::parse($pengeluarandoc->first()->docdate)->format('d-m-Y');

        return view('it_admin.pengeluaran-show', [
                    'title' => 'pengeluaran-show',
                    'pengeluarans' => $pengeluarandoc,
                    'docDate' => $docDate,
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

    /**
     * Update the specified resource in storage.
     */
    public function cancel(Request $request, Pengeluaran $pengeluaran)
    {
        // Find all Pengeluaran instances with the given docnum
        $pengeluaranInstances = Pengeluaran::where('docnum', $pengeluaran->docnum)->get();

        if ($pengeluaranInstances->isEmpty()) {
            return redirect(route("pengeluarans"))->with('error', 'No Pengeluaran found with the specified docnum.');
        }

        // Loop through each Pengeluaran instance
        foreach ($pengeluaranInstances as $pengeluaranInstance) {
            // Find the Permintaan instance based on docnum and item_id
            $permintaan = Permintaan::where('docnum', $pengeluaranInstance->docnum)
                ->where('item_id', $pengeluaranInstance->item_id)
                ->first();

            if ($permintaan) {
                // Update the Permintaan's openqty
                $permintaan->openqty += $pengeluaranInstance->qty;
                $permintaan->status = 'Open';
                $permintaan->save();
            } else {
                // Handle the case where no matching Permintaan is found
                // You can add error handling logic here if needed.
            }

            // Update the Pengeluaran status to 'Canceled'
            $pengeluaranInstance->update(['status' => 'Canceled']);
        }

        return redirect(route("pengeluarans"))->with('success', 'Pengeluaran updated.');
    }


    /**
     * Update the specified resource in storage.
     */
    public function released(Request $request, Pengeluaran $pengeluaran)
    {
        //
        Pengeluaran::where('docnum', $pengeluaran->docnum)->update(['status' => 'Released']);
        return redirect(route("pengeluarans"))->with('success', 'Pengeluaran updated.');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');
            $user = auth()->user();
    
            if ($user->license !== 'staff') {
                $pengeluarans = Pengeluaran::where('docnum', 'like', '%' . $query . '%')
                    ->orWhere('admin', 'like', '%' . $query . '%')
                    ->orWhere('requester_name', 'like', '%' . $query . '%')
                    ->orWhere('remarks', 'like', '%' . $query . '%')
                    ->get();
            } else {
                $pengeluarans = Pengeluaran::where('docnum', 'like', '%' . $query . '%')
                    ->where('requester_id', $user->id)
                    ->orWhere('admin', 'like', '%' . $query . '%')
                    ->orWhere('requester_name', 'like', '%' . $query . '%')
                    ->orWhere('remarks', 'like', '%' . $query . '%')
                    ->get();
            }
    
            foreach ($pengeluarans as $pengeluaran) {
                $output .= view('it_admin.pengeluaran-row')->with('pengeluaran', $pengeluaran)->render();
            }
    
            return $output;
        }
    }
}
