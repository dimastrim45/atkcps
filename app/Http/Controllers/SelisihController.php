<?php

namespace App\Http\Controllers;

use App\Models\Selisih;
use App\Models\Item;
use App\Http\Requests\StoreSelisihRequest;
use App\Http\Requests\UpdateSelisihRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SelisihController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $selisihs = $selisihs = Selisih::whereIn('id', function($query) {
            $query->selectRaw('MIN(id)')
                ->from('selisihs')
                ->groupBy('docnum');
        })->paginate(20);
        
        return view('it_admin.selisih-index', [
            'title' => 'selisihs',
            'selisihs' => $selisihs,
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

        $latestSelisih = Selisih::orderBy('created_at', 'desc')->first();

        if ($latestSelisih) {
            // Extract the current month and year from the created_at timestamp
            $storedMonth = date('m', strtotime($latestSelisih->created_at));
            $storedYear = date('Y', strtotime($latestSelisih->created_at));

            if ($currentYear != $storedYear || $currentMonth != $storedMonth) {
                // If the current month and year are different, reset DocId to 1
                $nextID = 1;
            } else {
                // Increment the maximum DocId within the current month and year by 1
                $nextID = $latestSelisih->DocId + 1;
            }
        } else {
            // If there are no existing records, start with DocId 1
            $nextID = 1;
        }


        // Format the next ID as a three-digit string (e.g., 001)
        $formattedID = str_pad($nextID, 3, '0', STR_PAD_LEFT);

        // Loop through the items and insert them into the "barang_masuks" table
        $itemIds = $request->input('item_id');
        $qtys = $request->input('qty');

        foreach ($itemIds as $key => $itemId) {
            // Create a new instance of the selisih model for each item
            $selisih = new Selisih();
            $selisih->docnum = $currentYear . $currentMonth . $formattedID;
            $selisih->DocId = $nextID;
            // Convert the docdate to the desired format (dd-mm-yyyy)
            $currentDate = Carbon::now()->format('Y-m-d');
            $selisih->docdate = $currentDate;
            $selisih->remarks = $request->input('remarks');
            $selisih->admin = auth()->user()->name; // Assuming you're storing the admin's name
            $selisih->status = 'Open';

            // Set the item-specific data
            $selisih->item_id = $itemId;
            $selisih->qty = $qtys[$key];

            // Save the current item to the database
            $selisih->save();
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
        // dd($selisih);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Selisih $selisih)
    {
        //
        $selisihdoc = Selisih::where('docnum', $selisih->docnum)->get();
        $items = Item::where('status', 'active')->get();

        return view('it_admin.selisih-edit', [
                    'title' => 'selisih-edit',
                    'selisihs' => $selisihdoc,
                    'items' => $items,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSelisihRequest $request, Selisih $selisih)
    {
        // Assuming the form fields are named item_id[], uom[], and qty[]
        $itemIds = $request->input('item_id');
        $qtys = $request->input('qty');

        foreach ($itemIds as $index => $itemId) {
            $selisih = Selisih::findOrFail($itemId); // Assuming $itemId corresponds to Selisih's id

            // Update the Selisih model with the new data
            $selisih->update([
                'qty' => $qtys[$index],
            ]);
        }
        
        return redirect(route('selisihs'))->with('success', 'Selisih stock updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Selisih $selisih)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function reject(Request $request, Selisih $selisih)
    {
        //
        Selisih::where('docnum', $selisih->docnum)->update(['status' => 'Rejected']);
        return redirect(route("selisihs"))->with('success', 'Selisih updated.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function approve(Request $request, Selisih $selisih)
    {
        // Get the item_ids and corresponding qtys from Selisih table where docnum matches
        $itemsToUpdate = Selisih::where('docnum', $selisih->docnum)
        ->select('item_id', 'qty')
        ->get();

        foreach ($itemsToUpdate as $itemToUpdate) {
            $itemId = $itemToUpdate->item_id;
            $qty = $itemToUpdate->qty;

            // Update the corresponding item in the "Item" table:
            $item = Item::find($itemId);
            if ($item) {
                // Set the item's qty to the qty from Selisih
                $item->qty = $qty;
                $item->save();
            }
        }
        Selisih::where('docnum', $selisih->docnum)->update(['status' => 'Approved']);
        return redirect(route("selisihs"))->with('success', 'Selisih updated.');
    }


}