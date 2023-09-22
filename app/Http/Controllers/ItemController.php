<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemGroup;
use Illuminate\Http\Request;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
// use Carbon\Carbon;
// use Illuminate\Pagination\Paginator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::paginate(20);
        $itemgroups = ItemGroup::all();

        return view('it_admin.items',[
            "title" => 'items',
            "items" => $items,
            "itemgroups" => $itemgroups,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $itemgroups = ItemGroup::all();

        return view('it_admin.item-add',[
            "title" => 'itemadd',
            "itemgroups" => $itemgroups,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        // dd($request);
        // Validate the request data using the StoreItemRequest validation rules
        $validatedData = $request->validated();

        // Create a new Item record using the validated data
        Item::create($validatedData);

        return redirect()->back()->with('success', 'Item Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
        // dd($item);
        $itemgroups = ItemGroup::all();

        return view('it_admin.item-edit',[
            "title" => 'itemedit',
            'item' => $item,
            "itemgroups" => $itemgroups,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        //
        // dd($item);

        // Update the ItemGroup using the code as the identifier
        $item->update($request->validated());
        return redirect()->back()->with('success', 'Item updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }

    // to set the status of selected item to active
    public function active(Request $request, Item $item)
    {
        //
        // dd($item->id);
        Item::where('id', $item->id)->update(['status' => 'active']);
        return redirect(route("items"))->with('success', 'Item updated.');
    }

    // to set the status of selected item to inactive
    public function inactive(Request $request, Item $item)
    {
        //
        // dd($item->id);
        Item::where('id', $item->id)->update(['status' => 'inactive']);
        return redirect(route("items"))->with('success', 'Item updated.');
    }

    public function search(Request $request)
    {
        $itemgroups = ItemGroup::all();
        $query = $request->input('query');

        // Perform the search query using Eloquent or other database methods
        $items = Item::where('name', 'like', '%' . $query . '%')->get();

        return view('it_admin.items', [
            'items' => $items,
            'title' => 'itemsSearch',
            'itemgroups' => $itemgroups,
        ]);
    }
}
