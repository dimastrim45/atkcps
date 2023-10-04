<?php

namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('it_admin.report-index', [
            'title' => 'reports',
        ]);
    }

    public function itemList(){
        $items = Item::all();
        return view('it_admin.report-item-index', [
            'title' => 'Item List Report',
            'items' => $items,
        ]);
    }
}
