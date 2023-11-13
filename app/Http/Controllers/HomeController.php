<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use App\Models\BarangMasuk;
use App\Models\Pengeluaran;
use App\Models\User;
use App\Models\Item;
use App\Models\ItemGroup;
use Illuminate\Http\Request;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('it_admin.home',[
            'title' => 'adminhome'
        ]);
    }

    public function no_license()
    {
        return view('it_admin.users.no-license',[
            'title' => 'no-license'
        ]);
    }

    // admin
    public function indexadminit()
    {
        $today = Carbon::today();
        $threeDaysAgo = $today->subDays(3);

        // Query to get user count
        $userCount = User::count();

        // Query to get new Permintaan created today
        $newPermintaan = Permintaan::select(\DB::raw('COUNT(DISTINCT docnum) as count'))
            ->whereDate('created_at', $today)
            ->get();
        // Extract the count from the result
        $countNP = $newPermintaan[0]->count;

        // Query to get open permintaan
        $openPermintaan = Permintaan::select(\DB::raw('COUNT(DISTINCT docnum) as count'))
            ->where('status', 'Open')
            ->get();
        // Extract the count from the result
        $countOP = $openPermintaan[0]->count;

        $openPermintaanUser = Permintaan::select(\DB::raw('COUNT(DISTINCT docnum) as count'))
            ->where('status', 'Open')
            ->where('user_id', auth()->user()->id)
            ->get();
        // Extract the count from the result
        $countOPUser = $openPermintaanUser[0]->count;

        // Query to get open and overdue permintaan
        $overduePermintaan = Permintaan::select(\DB::raw('COUNT(DISTINCT docnum) as count'))
            ->whereDate('duedate', '<', $threeDaysAgo)
            ->where('status', 'Open')
            ->get();
        // Extract the count from the result
        $countOVP = $overduePermintaan[0]->count;

        // Query to get open and overdue permintaan By User
        $overduePermintaanUser = Permintaan::select(\DB::raw('COUNT(DISTINCT docnum) as count'))
            ->whereDate('duedate', '<', $threeDaysAgo)
            ->where('status', 'Open')
            ->where('user_id', auth()->user()->id)
            ->get();
        // Extract the count from the result
        $countOVPUser = $overduePermintaanUser[0]->count;

        // Query to get closed permintaan
        $closedPermintaan = Permintaan::select(\DB::raw('COUNT(DISTINCT docnum) as count'))
            ->where('status', 'Closed')
            ->get();
        // Extract the count from the result
        $countCP = $closedPermintaan[0]->count;

        // Query to get closed permintaan By User
        $closedPermintaanUser = Permintaan::select(\DB::raw('COUNT(DISTINCT docnum) as count'))
            ->where('status', 'Closed')
            ->where('user_id', auth()->user()->id)
            ->get();
        // Extract the count from the result
        $countCPUser = $closedPermintaanUser[0]->count;

        // Query to get rejected permintaan
        $rejectedPermintaan = Permintaan::select(\DB::raw('COUNT(DISTINCT docnum) as count'))
            ->where('status', 'Rejected')
            ->get();
        // Extract the count from the result
        $countRP = $rejectedPermintaan[0]->count;

        // Query to get open pengeluaran barang
        $openPengeluaran = Pengeluaran::select(\DB::raw('COUNT(DISTINCT docnum) as count'))
            ->where('status', 'Open')
            ->get();
        // Extract the count from the result
        $countOPG = $openPengeluaran[0]->count;

        // Query to get open and overdue pengeluaran barang
        $overduePengeluaran = Pengeluaran::select(\DB::raw('COUNT(DISTINCT docnum) as count'))
            ->whereDate('created_at', '<', $threeDaysAgo)
            ->where('status', 'Open')
            ->get();
        // Extract the count from the result
        $countOVPG = $overduePengeluaran[0]->count;

        // Query to get Canceled Barang Masuk
        $canceledBarangMasuk = BarangMasuk::select(\DB::raw('COUNT(DISTINCT docnum) as count'))
            ->where('status', 'Canceled')
            ->get();
        // Extract the count from the result
        $countCBM = $canceledBarangMasuk[0]->count;

        return view('it_admin.home',[
            'title' => 'adminhome',
            'userCount' => $userCount,
            'newPermintaan' => $countNP,
            'openPermintaan' => $countOP,
            'overduePermintaan' => $countOVP,
            'closedPermintaan' => $countCP,
            'openPengeluaran' => $countOPG,
            'overduePengeluaran' => $countOVPG,
            'rejectedPermintaan' => $countRP,
            'canceledBarangMasuk' => $countCBM,
            'openPermintaanUser' => $countOPUser,
            'overduePermintaanUser' => $countOVPUser,
            'closedPermintaanUser' => $countCPUser,
        ]);
    }

    // show canceled barang masuk
    public function canceledBM() {
        $barangmasuks = BarangMasuk::whereIn('id', function ($query) {
            $query->selectRaw('MIN(id)')
                ->from('barang_masuks')
                ->groupBy('docnum');
        })->where('status', 'Canceled')
            ->paginate(20);
    
        return view('it_admin.barang-masuk-index', [
            'title' => 'barangmasuks',
            'barangmasuks' => $barangmasuks,
        ]);
    }

    // show rejected permintaan
    public function rejectedPermintaan() {
        $permintaans = Permintaan::whereIn('id', function($query) {
            $query->selectRaw('MIN(id)')
                ->from('permintaans')
                ->groupBy('docnum');
        })->where('status', 'Rejected')
            ->paginate(20);
    
        return view('it_admin.permintaan-index', [
            'title' => 'permintaans',
            'permintaans' => $permintaans,
        ]);
    }

    // show permintaan created today
    public function newPermintaan() {
        // Get today's date in the format 'Y-m-d'
        $today = Carbon::now()->toDateString();
    
        $permintaans = Permintaan::whereIn('id', function($query) {
            $query->selectRaw('MIN(id)')
                ->from('permintaans')
                ->groupBy('docnum');
        })->whereDate('created_at', $today) // Filter by created_at date of today
            ->paginate(20);
    
        return view('it_admin.permintaan-index', [
            'title' => 'permintaans',
            'permintaans' => $permintaans,
        ]);
    }

    // show Open permintaan
    public function openPermintaan() {
        $permintaans = Permintaan::whereIn('id', function($query) {
            $query->selectRaw('MIN(id)')
                ->from('permintaans')
                ->groupBy('docnum');
        })->where('status', 'Open')
            ->paginate(20);
    
        return view('it_admin.permintaan-index', [
            'title' => 'permintaans',
            'permintaans' => $permintaans,
        ]);
    }

    // show overdue permintaan
    public function overduePermintaan() {
        // Get today's date in the format 'Y-m-d'
        $today = Carbon::now()->toDateString();
    
        $permintaans = Permintaan::whereIn('id', function($query) {
            $query->selectRaw('MIN(id)')
                ->from('permintaans')
                ->groupBy('docnum');
        })->where('duedate', '<', $today) // Filter by duedate smaller than today
            ->paginate(20);
    
        return view('it_admin.permintaan-index', [
            'title' => 'permintaans',
            'permintaans' => $permintaans,
        ]);
    }

    // show Closed permintaan
    public function closedPermintaan() {
        $permintaans = Permintaan::whereIn('id', function($query) {
            $query->selectRaw('MIN(id)')
                ->from('permintaans')
                ->groupBy('docnum');
        })->where('status', 'Closed')
            ->paginate(20);
    
        return view('it_admin.permintaan-index', [
            'title' => 'permintaans',
            'permintaans' => $permintaans,
        ]);
    }

    // show Open Pengeluaran
    public function openPengeluaran() {
        $pengeluarans = Pengeluaran::whereIn('id', function($query) {
            $query->selectRaw('MIN(id)')
                ->from('pengeluarans')
                ->groupBy('docnum');
        })->where('status', 'Open')
            ->paginate(20);
    
        return view('it_admin.pengeluaran-index', [
            'title' => 'pengeluarans',
            'pengeluarans' => $pengeluarans,
        ]);
    }

    // show overdue Pengeluaran
    public function overduePengeluaran() {
        // Get today's date in the format 'Y-m-d'
        $today = Carbon::now()->toDateString();
    
        $pengeluarans = Pengeluaran::whereIn('id', function($query) {
            $query->selectRaw('MIN(id)')
                ->from('pengeluarans')
                ->groupBy('docnum');
        })->where('duedate', '<', $today) // Filter by duedate smaller than today
            ->paginate(20);
    
        return view('it_admin.permintaan-index', [
            'title' => 'pengeluarans',
            'pengeluarans' => $pengeluarans,
        ]);
    }

    public function expItems() {
        // Get today's date in the format 'Y-m-d'
        $today = Carbon::now()->toDateString();
    
        $expItems = Item::where('expdate', '<', $today)
            ->paginate(20);
        $itemgroups = ItemGroup::all();
    
        return view('your_view_name', [
            'title' => 'Expired Items',
            'expItems' => $expItems,
        ]);
    }
}

