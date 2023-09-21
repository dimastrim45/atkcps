<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemGroupController;
use App\Http\Controllers\HomeController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\BarangMasukController;
use \App\Http\Controllers\PermintaanController;
use \App\Http\Controllers\PengeluaranController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function ()
//     return view('welcome');
// });

// using auth standart route
Auth::routes();

// first login
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// all route below has to pass authorization
Route::middleware('auth')->group(function () {

    // for admin
    Route::get('homeadminit', [HomeController::class, 'indexadminit'])->name('homeadminit');

    // Item CRUD
    Route::get('items', [ItemController::class, 'index'])->name('items');
    Route::get('items/search', [ItemController::class, 'search'])->name('item.search');
    Route::get('itemadd', [ItemController::class, 'create'])->name('itemadd');
    Route::post('itemadd', [ItemController::class, 'store'])->name('itemadd');
    Route::get('itemgroups', [ItemGroupController::class, 'index'])->name('itemgroups.index');
    Route::get('itemgroups/create', [ItemGroupController::class, 'create'])->name('itemgroups.create');
    Route::post('itemgroups/store', [ItemGroupController::class, 'store'])->name('itemgroups.store');
    Route::get('itemgroups/edit/{itemgroup:code}', [ItemGroupController::class, 'edit']);
    Route::put('itemgroups/edit/{itemgroup:code}', [ItemGroupController::class, 'update']);
    Route::put('items/inactive/{item:id}', [ItemController::class, 'inactive'])->name('item.inactive');
    Route::put('items/active/{item:id}', [ItemController::class, 'active'])->name('item.active');

    // Barang Masuk
    Route::get('barangmasuks', [BarangMasukController::class, 'index'])->name('barangmasuks');
    Route::get('barangmasukadd', [BarangMasukController::class, 'create'])->name('barangmasukadd');
    Route::post('barangmasukadd/store', [BarangMasukController::class, 'store'])->name('barangmasukadd.store');
    Route::get('barangmasuk/show/{barangmasuk:docnum}', [BarangMasukController::class, 'show'])->name('barangmasuk.show');
    // Route::get('barangmasuk/show/{barangmasuk}', [BarangMasukController::class, 'show'])->name('barangmasuk.show');

    // Permintaan CRUD
    Route::get('permintaans', [PermintaanController::class, 'index'])->name('permintaans');
    Route::get('permintaanadd', [PermintaanController::class, 'create'])->name('permintaanadd');
    Route::post('permintaanadd/store', [PermintaanController::class, 'store'])->name('permintaanadd.store');
    Route::get('permintaan/show/{permintaan:docnum}', [PermintaanController::class, 'show'])->name('permintaan.show');
    Route::put('permintaan/close/{permintaan:id}', [PermintaanController::class, 'close'])->name('permintaan.close');
    Route::put('permintaan/reject/{permintaan:id}', [PermintaanController::class, 'reject'])->name('permintaan.reject');

    // Pengeluaran
    Route::get('pengeluarans', [PengeluaranController::class, 'index'])->name('pengeluarans');
    Route::get('pengeluaranadd', [PengeluaranController::class, 'create'])->name('pengeluaranadd');
    Route::post('pengeluaranadd/store', [PengeluaranController::class, 'store'])->name('pengeluaranadd.store');
    Route::get('pengeluaran/show/{pengeluaran:docnum}', [PengeluaranController::class, 'show'])->name('pengeluaran.show');



    // Selisih for stock opnam
    Route::view('selisihs', 'it_admin.selisihs', ['title' => 'selisihs'])->name('selisihs');

    // Feedback
    Route::view('feedbacks', 'it_admin.feedbacks', ['title' => 'feedbacks'])->name('feedbacks');

    // Plant Management
    Route::view('plants', 'it_admin.plants', ['title' => 'plants'])->name('plants');
    
    // user CRUD
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('user/edit/{user:email}',[UserController::class, 'edit']);
    Route::put('user/edit/{user:email}',[UserController::class, 'update']);
    Route::delete('user/remove/{user:id}',[UserController::class, 'delete']);
    Route::delete('/users/{user}', [UserController::class, 'delete'])->name('users.delete');
    
    // Profile
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'showITAdmin'])->name('profile.showITAdmin');
});
