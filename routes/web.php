<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\HomeController;
use \App\Http\Controllers\UserController;

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
    Route::get('items', [ItemController::class, 'index'])->name('items');

    // Item CRUD
    Route::view('itemadd', 'it_admin.item-add', ['title' => 'itemadd'])->name('itemadd');
    Route::view('itemgroups', 'it_admin.item-groups', ['title' => 'itemgroups'])->name('itemgroups');
    Route::view('itemgrpadd', 'it_admin.item-group-add', ['title' => 'groupadd'])->name('itemgrpadd');

    // Permintaan CRUD
    Route::view('requests', 'it_admin.requests', ['title' => 'requests'])->name('requests');
    Route::view('requestadd', 'it_admin.request-add', ['title' => 'addrequest'])->name('requestadd');

    // Barang Masuk
    Route::view('barangmasuks', 'it_admin.pemasukans', ['title' => 'barangmasuks'])->name('barangmasuks');
    Route::view('barangmasukadd', 'it_admin.pemasukan-add', ['title' => 'barangmasukadd'])->name('barangmasukadd');

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
