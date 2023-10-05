<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\User;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    // show reports pagw
    public function index()
    {
        return view('it_admin.report-index', [
            'title' => 'reports',
        ]);
    }

    // item list report
    public function itemList(){
        $items = Item::all();
        return view('it_admin.report-item-index', [
            'title' => 'Item List Report',
            'items' => $items,
        ]);
    }

    public function itemList_print_pdf()
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

    // userlist report
    public function userList(){
        $users = User::all();
        return view('it_admin.report-userlist-index', [
            'title' => 'User List Report',
            'users' => $users,
        ]);
    }

    public function userList_print_pdf()
    {
        $users = User::all();

        // return view('it_admin.report-userlist-index-pdf', [
        //     'title' => 'User List Report',
        //     'users' => $users,
        // ]);
    
        $pdf = PDF::loadview('it_admin.report-userlist-index-pdf',[
            'title' => 'User List Report',
            'users' => $users,
        ])->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream();
    }

    // Barang Masuk Report
    public function BMByDate(Request $request){
        // Get the "from-date" and "to-date" values from the request
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        // Query the BarangMasuk model to retrieve data within the date range
        $barangMasuks = BarangMasuk::whereBetween('docdate', [$fromDate, $toDate])->get();

        return view('it_admin.report-bm-bydate-index', [
            'title' => 'BM List By Date Report',
            'barangmasuks' => $barangMasuks,
        ]);
    }

    public function BMByDate_print_pdf(Request $request)
    {
        // Get the "from-date" and "to-date" values from the request
        $fromDate = $request->input('from-date');
        $toDate = $request->input('to-date');

        // Query the BarangMasuk model to retrieve data within the date range
        $barangMasuks = BarangMasuk::whereBetween('docdate', [$fromDate, $toDate])->get();

        // return view('it_admin.report-userlist-index-pdf', [
        //     'title' => 'User List Report',
        //     'users' => $users,
        // ]);
    
        $pdf = PDF::loadview('it_admin.report-userlist-index-pdf',[
            'title' => 'User List Report',
            'users' => $users,
        ])->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream();
    }
}
