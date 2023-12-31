<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemGroup;
use Illuminate\Http\Request;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use Illuminate\Support\Facades\DB;
use App\Imports\ItemImport;
use Maatwebsite\Excel\Facades\Excel;
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

        return redirect(route("items"))->with('success', 'Item Created');
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
        return redirect(route("items"))->with('success', 'Item updated.');
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
        if ($request->ajax()) {
            $output = '';
            $query = $request->get('query');

            if ($query != '') {
                // Perform a search based on the query
                $items = Item::where('name', 'like', '%' . $query . '%')->get();
            } else {
                // If the query is empty, retrieve all items and paginate them
                $items = Item::paginate(20);
            }

            foreach ($items as $item) {
                // Build the HTML for each row
                $output .= view('it_admin.item-row')->with('item', $item)->render();
            }

            return $output;
        }
    }

    public function import(Request $request)
    {
        // validasi
		$this->validate($request, [
			'excelFile' => 'required|mimes:csv,xls,xlsx'
		]);

        // menangkap file excel
		$file = $request->file('excelFile');

        // membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();

        // upload ke folder file_item di dalam folder public
		$file->move('file_item',$nama_file);

        // import data
		Excel::import(new ItemImport, public_path('/file_item/'.$nama_file));

        return redirect(route("items"))->with('success', 'Items imported successfully');
    }
}
