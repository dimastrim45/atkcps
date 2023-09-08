<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemGroup;
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
