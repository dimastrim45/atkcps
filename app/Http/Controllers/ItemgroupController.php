<?php

namespace App\Http\Controllers;

use App\Models\ItemGroup;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\StoreItemGroupRequest;
use App\Http\Requests\UpdateItemGroupRequest;

class ItemGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $itemgroups = ItemGroup::paginate(10);

        return view('it_admin.item-groups',[
            "title" => 'itemgroups',
            "itemgroups" => $itemgroups,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('it_admin.item-group-add',[
            "title" => 'itemgrpadd',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemGroupRequest $request)
    {
        //Validating Data
        $validatedData = $request->validated();
        // dd($validatedData);

        // Create a new Item Group record using the validated data
        ItemGroup::create($validatedData);

        return redirect()->back()->with('success', 'Item Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(ItemGroup $itemGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemGroup $itemgroup)
    {
        // dd($itemGroup);
        return view('it_admin.item-group-edit',[
            "title" => 'itemgrpedit',
            'itemgroup' => $itemgroup,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItemGroup $itemgroup)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('item_groups', 'name')->ignore($itemgroup->id),],
            'code' => ['required', 'string', Rule::unique('item_groups', 'code')->ignore($itemgroup->id),],
        ]);
        // dd($validatedData);

        // Update the ItemGroup using the code as the identifier
        ItemGroup::where('id', $itemgroup->id)->update($validatedData);

        return redirect(route("itemgroups.index"))->with('success', 'Item Group updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemGroup $itemGroup)
    {
        //
    }
}
