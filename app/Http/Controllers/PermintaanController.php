<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use App\Models\Item;
use App\Http\Requests\StorePermintaanRequest;
use App\Http\Requests\UpdatePermintaanRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $items = Item::where('status', 'active')->get();
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
        // Get the current year and month
        $currentYear = date('Y');
        $currentMonth = date('m');

        // Determine the next available ID for the current month
        $nextID = Permintaan::whereYear('created_at', '=', $currentYear)
            ->whereMonth('created_at', '=', $currentMonth)
            ->max('id') + 1;

        // Format the next ID as a three-digit string (e.g., 001)
        $formattedID = str_pad($nextID, 3, '0', STR_PAD_LEFT);

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

            if ($item && $item->qty - $qtys[$key] >= 0) {
                // Continue validating other items
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
                // Create a new instance of the Permintaan model for each item
                $permintaan = new Permintaan();
                $permintaan->docnum = $currentYear . $currentMonth . $formattedID;
                // Convert the docdate to the desired format (dd-mm-yyyy)
                $currentDate = Carbon::now()->format('Y-m-d');
                $permintaan->docdate = $currentDate;
                $permintaan->duedate = $request->input('duedate');
                $permintaan->user_id = auth()->id();
                $permintaan->status = "Open";
                $permintaan->remarks = $request->input('remarks');
                $permintaan->requester = auth()->user()->name; // Assuming you're storing the requester's name

                // Set the item-specific data
                $permintaan->item_id = $itemId;
                $permintaan->qty = $qtys[$key];
                $permintaan->openqty = $qtys[$key];
                $permintaan->expdate = $expDates[$key];
                $permintaan->price = $prices[$key];

                // Save the current item to the database
                $permintaan->save();

                // Update the item's quantity
                $item->qty -= $qtys[$key];
                $item->save();
            }

            // Redirect back or to a success page after all items are saved
            return redirect()->route('permintaans');
        } else {
            // Handle the case where at least one item is not valid
            // You can add an error message or redirect with a message
            return redirect()->back()->withErrors(['error' => 'At least one item has insufficient quantity.']);
        }
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

    /**
     * Update the specified resource in storage.
     */
    public function close(Request $request, Permintaan $permintaan)
    {
        //
        Permintaan::where('id', $permintaan->id)->update(['status' => 'Closed']);
        return redirect(route("permintaans"))->with('success', 'Permintaan updated.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function reject(Request $request, Permintaan $permintaan)
    {
        // Find all Permintaan instances with the given docnum
        $permintaanInstances = Permintaan::where('docnum', $permintaan->docnum)->get();

        if ($permintaanInstances->isEmpty()) {
            return redirect(route("permintaans"))->with('error', 'No Permintaan found with the specified docnum.');
        }

        // Loop through each Permintaan instance
        foreach ($permintaanInstances as $permintaanInstance) {
            $item = Item::find($permintaanInstance->item_id);
            $item->qty += $permintaanInstance->openqty;
            $item->save();

            $permintaanInstance->openqty = 0;

            // Update the Permintaan status to 'Rejected'
            $permintaanInstance->update(['status' => 'Rejected']);
        }


        // Permintaan::where('docnum', $permintaan->docnum)->update(['status' => 'Rejected']);
        return redirect(route("permintaans"))->with('success', 'Permintaan updated.');
    }
}
