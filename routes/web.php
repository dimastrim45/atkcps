<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemGroupController;
use App\Http\Controllers\HomeController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\BarangMasukController;


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

    // Permintaan CRUD
    Route::view('requests', 'it_admin.requests', ['title' => 'requests'])->name('requests');
    Route::view('requestadd', 'it_admin.request-add', ['title' => 'addrequest'])->name('requestadd');

    // Barang Masuk
    Route::get('barangmasuks', [BarangMasukController::class, 'index'])->name('barangmasuks');
    Route::get('barangmasukadd', [BarangMasukController::class, 'create'])->name('barangmasukadd');
    Route::post('barangmasukadd/store', [BarangMasukController::class, 'store'])->name('barangmasukadd.store');

    // Pengeluaran
    Route::view('pengeluarans', 'it_admin.pengeluarans', ['title' => 'pengeluarans'])->name('pengeluarans');

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
