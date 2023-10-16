<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use App\Models\Pengeluaran;
use App\Models\User;
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

        // Query to get open and overdue permintaan
        $overduePermintaan = Permintaan::select(\DB::raw('COUNT(DISTINCT docnum) as count'))
            ->whereDate('duedate', '<', $threeDaysAgo)
            ->where('status', 'Open')
            ->get();
        // Extract the count from the result
        $countOVP = $overduePermintaan[0]->count;

        // Query to get closed permintaan
        $closedPermintaan = Permintaan::select(\DB::raw('COUNT(DISTINCT docnum) as count'))
            ->where('status', 'Closed')
            ->get();
        // Extract the count from the result
        $countCP = $closedPermintaan[0]->count;

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

        return view('it_admin.home',[
            'title' => 'adminhome',
            'userCount' => $userCount,
            'newPermintaan' => $countNP,
            'openPermintaan' => $countOP,
            'overduePermintaan' => $countOVP,
            'closedPermintaan' => $countCP,
            'openPengeluaran' => $countOPG,
            'overduePengeluaran' => $countOVPG,
        ]);
    }
}

