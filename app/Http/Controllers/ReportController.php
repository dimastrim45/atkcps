<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\User;
use App\Models\BarangMasuk;
use App\Models\Permintaan;
use App\Models\Pengeluaran;
use App\Models\Selisih;
use App\Models\MovingAverage;
use App\Exports\ItemListReportExport;
use App\Exports\UserListReportExport;
use App\Exports\BMByDateReportExport;
use App\Exports\PermintaanByDateReportExport;
use App\Exports\PermintaanByReqReportExport;
use App\Exports\PengeluaranByDateReportExport;
use App\Exports\PengeluaranByReqReportExport;
use App\Exports\SelisihByDateReportExport;
use App\Exports\MinimumQtyReportExport;
use App\Exports\MovingAvgReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use PDF;


class ReportController extends Controller
{
    // show reports pagw
    public function index()
    {
        $users = User::all();
        return view('it_admin.report-index', [
            'title' => 'reports',
            'users' => $users,
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
    public function exportToExcelItemList()
    {
        return Excel::download(new ItemListReportExport, 'item.xlsx');
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
    public function exportToExcelUserList()
    {
        return Excel::download(new UserListReportExport, 'User List.xlsx');
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
    public function exportToExcelBMByDate(Request $request)
    {
        return Excel::download(new BMByDateReportExport($request), 'BMByDateReport.xlsx');
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
    public function exportToExcelPermintaanByDate(Request $request)
    {
        return Excel::download(new PermintaanByDateReportExport($request), 'PermintaanByDateReport.xlsx');
    }
    public function PermintaanByReq(Request $request){
        // Get the requester values from the request
        $requester_id = $request->input('requester_id');
        $requester = User::where('id', $requester_id)->first();

        /// Query the Permintaan model to retrieve data where user_id matches requester
        $permintaans = Permintaan::where('user_id', $requester_id)->get();

        if ($permintaans->isEmpty()) {
            // Redirect to 'reports' route with an error message
            return redirect()->back()->with('error', 'Data Not Found');
            
        }

        return view('it_admin.report-permintaan-byreq-index', [
            'title' => 'Permintaan List By Requester Report',
            'permintaans' => $permintaans,
            'requester' => $requester,
        ]);
    }
    public function PermintaanByReq_print_pdf(Request $request)
    {
        // Get the requester values from the request
        $requester_id = $request->input('requester_id');
        $requester = User::where('id', $requester_id)->first();

        /// Query the Permintaan model to retrieve data where user_id matches requester
        $permintaans = Permintaan::where('user_id', $requester_id)->get();
    
        $pdf = PDF::loadview('it_admin.report-permintaan-byreq-pdf',[
            'title' => 'Permintaan List By Requester Report',
            'permintaans' => $permintaans,
            'requester' => $requester,
        ])->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream();
    }
    public function exportToExcelPermintaanByReq(Request $request)
    {
        return Excel::download(new PermintaanByReqReportExport($request), 'PermintaanByReqReport.xlsx');
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
    public function exportToExcelPengeluaranByDate(Request $request)
    {
        return Excel::download(new PengeluaranByDateReportExport($request), 'PengeluaranByDateReport.xlsx');
    }
    public function PengeluaranByReq(Request $request){
        // Get the requester values from the request
        $requester_id = $request->input('requester_id');
        // $requester = User::where('id', $requester_id)->first();

        /// Query the Pengeluaran model to retrieve data where user_id matches requester
        $pengeluarans = Pengeluaran::where('requester_id', $requester_id)->get();

        if ($pengeluarans->isEmpty()) {
            // Redirect to 'reports' route with an error message
            return redirect()->back()->with('error', 'Data Not Found');
            
        }
    
        return view('it_admin.report-pengeluaran-byreq-index', [
            'title' => 'Pengeluaran List By Date Report',
            'pengeluarans' => $pengeluarans,
        ]);
    }
    public function PengeluaranByReq_print_pdf(Request $request)
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
    public function exportToExcelPengeluaranByReq(Request $request)
    {
        return Excel::download(new PengeluaranByReqReportExport($request), 'PengeluaranByReqReport.xlsx');
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
    public function exportToExcelSelisihByDate(Request $request)
    {
        return Excel::download(new SelisihByDateReportExport($request), 'SelisihByDateReport.xlsx');
    }

    // Minimum Qty Item report
    public function minimumQty(){
        // $items = Item::all();
        $items = Item::where('qty', '<=', 'min_qty')->get();
        return view('it_admin.report-minimumqty-index', [
            'title' => 'Minimum Qty Report',
            'items' => $items,
        ]);
    }
    public function exportToExcelMinimumQty()
    {
        return Excel::download(new MinimumQtyReportExport, 'MinimumQtyItem.xlsx');
    }

    // Moving Avergage report
    public function movingAvg(){
        $movingavgs = MovingAverage::all();
        return view('it_admin.report-movingavg-index', [
            'title' => 'Minimum Qty Report',
            'movingavgs' => $movingavgs,
        ]);
    }
    public function exportToExcelMovingAvg()
    {
        return Excel::download(new MovingAvgReportExport, 'MovingAverage.xlsx');
    }

    // inventory in warehouse report
    public function inventoryInWhs() {
        // Retrieve a list of all items
        $items = Item::all();
    
        // Initialize an array to store the inventory data for each item
        $inventoryData = [];
    
        // Loop through each item and calculate the inventory information
        foreach ($items as $item) {
            // Calculate the total Permintaan quantity with "Open" status for the item
            $totalPermintaan = Permintaan::where('item_id', $item->id)
                ->where('status', 'Open')
                ->sum('qty');
    
            // Calculate the total Pengeluaran quantity with "Open" status for the item
            $totalPengeluaran = Pengeluaran::where('item_id', $item->id)
                ->where('status', 'Open')
                ->sum('qty');
    
            // Calculate the Available quantity for the item
            $available = $item->qty - $totalPermintaan;
    
            // Calculate the Total value for the item
            $totalValue = $item->price * $item->qty;
    
            // Create an array with the calculated inventory data for the item
            $inventoryItemData = [
                'item_name' => $item->name,
                'uom' => $item->uom,
                'in_stock' => $item->qty,
                'permintaan' => $totalPermintaan,
                'pengeluaran_barang' => $totalPengeluaran,
                'available' => $available,
                'item_price_per_uom' => $item->price,
                'total' => $totalValue,
            ];
    
            // Add the item's inventory data to the inventoryData array
            $inventoryData[] = $inventoryItemData;
        }

        // dd($inventoryData);
    
        return view('it_admin.report-inventoryinwhs-index', [
            'title' => 'Inventory in Warehouse',
            'inventoryData' => $inventoryData,
        ]);
    }
}
