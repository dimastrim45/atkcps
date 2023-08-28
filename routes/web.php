<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('homeadminit', [App\Http\Controllers\HomeController::class, 'indexadminit'])->name('homeadminit');

Route::middleware('auth')->group(function () {
//     // user management
// Route::get('/register', function () {
//     return view('admin.user-add', [
//         "title" => 'register',
//         "divisis" => Divisi::all()
//     ]);
// });
    Route::view('items', 'it_admin.items', ['title' => 'items'])->name('items');

    Route::view('itemadd', 'it_admin.item-add', ['title' => 'itemadd'])->name('itemadd');
    Route::view('itemgroups', 'it_admin.item-groups', ['title' => 'itemgroups'])->name('itemgroups');
    Route::view('itemgrpadd', 'it_admin.item-group-add')->name('itemgrpadd');

    Route::view('requests', 'it_admin.requests', ['title' => 'requests'])->name('requests');
    Route::view('requestadd', 'it_admin.request-add')->name('requestadd');

    Route::view('barangmasuks', 'it_admin.pemasukans', ['title' => 'barangmasuks'])->name('barangmasuks');

    Route::view('pengeluarans', 'it_admin.pengeluarans', ['title' => 'pengeluarans'])->name('pengeluarans');
    Route::view('selisihs', 'it_admin.selisihs', ['title' => 'selisihs'])->name('selisihs');
    Route::view('feedbacks', 'it_admin.feedbacks', ['title' => 'feedbacks'])->name('feedbacks');
    Route::view('plants', 'it_admin.plants', ['title' => 'plants'])->name('plants');
    
    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
