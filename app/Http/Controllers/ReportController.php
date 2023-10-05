<?php

namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;
use PDF;

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

    public function print_pdf()
    {
        $items = Item::all();

        // return view('it_admin.report-item-index-pdf', [
        //     'title' => 'Item List Report',
        //     'items' => $items,
        // ]);
    
        $pdf = PDF::loadview('it_admin.report-item-index-pdf',[
            'items'=>$items,
            'title' => 'Item List Report',
        ])->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream();
    }
}
