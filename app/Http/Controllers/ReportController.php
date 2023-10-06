<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\User;
use App\Models\BarangMasuk;
use App\Models\Permintaan;
use App\Models\Pengeluaran;
use App\Models\Selisih;
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
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ]);
    }

    public function BMByDate_print_pdf(Request $request)
    {
        // Get the "from-date" and "to-date" values from the request
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        // Query the BarangMasuk model to retrieve data within the date range
        $barangMasuks = BarangMasuk::whereBetween('docdate', [$fromDate, $toDate])->get();
        
        $pdf = PDF::loadview('it_admin.report-bm-bydate-pdf',[
            'title' => 'BM List By Date Report',
            'barangmasuks' => $barangMasuks,
        ])->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream();
    }


    // Permintaan Report
    public function PermintaanByDate(Request $request){
        // Get the "from-date" and "to-date" values from the request
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        // Query the Permintaan model to retrieve data within the date range
        $permintaans = Permintaan::whereBetween('docdate', [$fromDate, $toDate])->get();

        return view('it_admin.report-permintaan-bydate-index', [
            'title' => 'Permintaan List By Date Report',
            'permintaans' => $permintaans,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ]);
    }

    public function PermintaanByDate_print_pdf(Request $request)
    {
        // Get the "from-date" and "to-date" values from the request
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        // Query the Permintaan model to retrieve data within the date range
        $permintaans = Permintaan::whereBetween('docdate', [$fromDate, $toDate])->get();
    
        $pdf = PDF::loadview('it_admin.report-permintaan-bydate-pdf',[
            'title' => 'Permintaan List By Date Report',
            'permintaans' => $permintaans,
        ])->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream();
    }
    

    // Pengeluaran Report
    public function PengeluaranByDate(Request $request){
        // Get the "from-date" and "to-date" values from the request
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        // Query the Pengeluaran model to retrieve data within the date range
        $pengeluarans = Pengeluaran::whereBetween('docdate', [$fromDate, $toDate])->get();

        return view('it_admin.report-pengeluaran-bydate-index', [
            'title' => 'Pengeluaran List By Date Report',
            'pengeluarans' => $pengeluarans,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ]);
    }

    public function PengeluaranByDate_print_pdf(Request $request)
    {
        // Get the "from-date" and "to-date" values from the request
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        // Query the Pengeluaran model to retrieve data within the date range
        $pengeluarans = Pengeluaran::whereBetween('docdate', [$fromDate, $toDate])->get();
    
        $pdf = PDF::loadview('it_admin.report-pengeluaran-bydate-pdf',[
            'title' => 'Pengeluaran List By Date Report',
            'pengeluarans' => $pengeluarans,
        ])->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream();
    }

    
    // Selisih Report
    public function SelisihByDate(Request $request){
        // Get the "from-date" and "to-date" values from the request
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        // Query the Selisih model to retrieve data within the date range
        $selisihs = Selisih::whereBetween('docdate', [$fromDate, $toDate])->get();

        return view('it_admin.report-selisih-bydate-index', [
            'title' => 'Selisih List By Date Report',
            'selisihs' => $selisihs,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ]);
    }

    public function SelisihByDate_print_pdf(Request $request)
    {
        // Get the "from-date" and "to-date" values from the request
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        // Query the Selisih model to retrieve data within the date range
        $selisihs = Selisih::whereBetween('docdate', [$fromDate, $toDate])->get();
    
        $pdf = PDF::loadview('it_admin.report-selisih-bydate-pdf',[
            'title' => 'Selisih List By Date Report',
            'selisihs' => $selisihs,
        ])->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream();
    }
}
