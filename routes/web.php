<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemGroupController;
use App\Http\Controllers\HomeController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\BarangMasukController;
use \App\Http\Controllers\PermintaanController;
use \App\Http\Controllers\PengeluaranController;
use \App\Http\Controllers\PlantController;
use \App\Http\Controllers\SelisihController;
use \App\Http\Controllers\ReportController;
use \App\Http\Controllers\FeedbackController;
use \App\Http\Controllers\ChatController;


// using auth standart route
Auth::routes();



// all route below has to pass authorization
Route::middleware('auth')->group(function () {

    // first login
    Route::get('/', [App\Http\Controllers\HomeController::class, 'indexadminit'])->name('home');

    // for admin
    Route::get('homeadminit', [HomeController::class, 'indexadminit'])->name('homeadminit');
    Route::get('no_license', [HomeController::class, 'no_license'])->name('no_license');
    Route::get('canceledbm', [HomeController::class, 'canceledBM'])->name('canceledbm');
    Route::get('rejectedpermintaaan', [HomeController::class, 'rejectedPermintaan'])->name('rejectedpermintaaan');
    Route::get('newpermintaan', [HomeController::class, 'newPermintaan'])->name('newpermintaan');
    Route::get('openpermintaan', [HomeController::class, 'openPermintaan'])->name('openpermintaan');
    Route::get('overduepermintaan', [HomeController::class, 'overduePermintaan'])->name('overduepermintaan');
    Route::get('closedpermintaan', [HomeController::class, 'closedPermintaan'])->name('closedpermintaan');
    Route::get('openpengeluaran', [HomeController::class, 'openPengeluaran'])->name('openpengeluaran');
    Route::get('expitems', [HomeController::class, 'expItems'])->name('expitems');

    // Item CRUD
    Route::get('items', [ItemController::class, 'index'])->name('items');
    Route::get('items/search', [ItemController::class, 'search'])->name('item.search');
    Route::get('itemadd', [ItemController::class, 'create'])->name('itemadd');
    Route::post('itemadd/store', [ItemController::class, 'store'])->name('itemadd.store');
    Route::get('item/edit/{item}', [ItemController::class, 'edit'])->name('item.edit');
    Route::put('item/update/{item}', [ItemController::class, 'update'])->name('item.update');
    Route::get('itemgroups', [ItemGroupController::class, 'index'])->name('itemgroups.index');
    Route::get('itemgroups/create', [ItemGroupController::class, 'create'])->name('itemgroups.create');
    Route::post('itemgroups/store', [ItemGroupController::class, 'store'])->name('itemgroups.store');
    Route::get('itemgroups/edit/{itemgroup:code}', [ItemGroupController::class, 'edit']);
    Route::put('itemgroups/edit/{itemgroup:code}', [ItemGroupController::class, 'update']);
    Route::put('items/inactive/{item:id}', [ItemController::class, 'inactive'])->name('item.inactive');
    Route::put('items/active/{item:id}', [ItemController::class, 'active'])->name('item.active');
    Route::post('items/import', [ItemController::class, 'import'])->name('items.import');

    // Barang Masuk
    Route::get('barangmasuks', [BarangMasukController::class, 'index'])->name('barangmasuks');
    Route::get('barangmasukadd', [BarangMasukController::class, 'create'])->name('barangmasukadd');
    Route::post('barangmasukadd/store', [BarangMasukController::class, 'store'])->name('barangmasukadd.store');
    Route::get('barangmasuk/show/{barangmasuk:docnum}', [BarangMasukController::class, 'show'])->name('barangmasuk.show');
    Route::get('barangmasuk/search', [BarangMasukController::class, 'search'])->name('barangmasuk.search');
    Route::put('barangmasuk/cancel/{barangmasuk:docnum}', [BarangMasukController::class, 'cancel'])->name('barangmasuk.cancel');
    Route::put('barangmasuk/cancellation/{barangmasuk:docnum}', [BarangMasukController::class, 'cancellation'])->name('barangmasuk.cancellation');
    Route::put('barangmasuk/approve/{barangmasuk:docnum}', [BarangMasukController::class, 'approve'])->name('barangmasuk.approve');

    // Permintaan CRUD
    Route::get('permintaans', [PermintaanController::class, 'index'])->name('permintaans');
    Route::get('permintaanadd', [PermintaanController::class, 'create'])->name('permintaanadd');
    Route::post('permintaanadd/store', [PermintaanController::class, 'store'])->name('permintaanadd.store');
    Route::get('permintaan/show/{permintaan:docnum}', [PermintaanController::class, 'show'])->name('permintaan.show');
    Route::put('permintaan/close/{permintaan:docnum}', [PermintaanController::class, 'close'])->name('permintaan.close');
    Route::put('permintaan/reject/{permintaan:docnum}', [PermintaanController::class, 'reject'])->name('permintaan.reject');
    Route::put('permintaan/open/{permintaan:docnum}', [PermintaanController::class, 'open'])->name('permintaan.open');
    Route::get('permintaan/search', [PermintaanController::class, 'search'])->name('permintaan.search');

    // Pengeluaran
    Route::get('pengeluarans', [PengeluaranController::class, 'index'])->name('pengeluarans');
    Route::get('pengeluaranadd', [PengeluaranController::class, 'create'])->name('pengeluaranadd');
    Route::post('pengeluaranadd/store', [PengeluaranController::class, 'store'])->name('pengeluaranadd.store');
    Route::get('pengeluaran/show/{pengeluaran:docnum}', [PengeluaranController::class, 'show'])->name('pengeluaran.show');
    Route::put('pengeluaran/cancel/{pengeluaran:docnum}', [PengeluaranController::class, 'cancel'])->name('pengeluaran.cancel');
    Route::put('pengeluaran/released/{pengeluaran:docnum}', [PengeluaranController::class, 'released'])->name('pengeluaran.released');
    Route::get('pengeluaran/search', [PengeluaranController::class, 'search'])->name('pengeluaran.search');

    // Selisih for stock opnam
    Route::get('selisihs', [SelisihController::class, 'index'])->name('selisihs');
    Route::get('selisihadd', [SelisihController::class, 'create'])->name('selisih.add');
    Route::post('selisihadd/store', [SelisihController::class, 'store'])->name('selisih.store');
    Route::put('selisih/reject/{selisih:docnum}', [SelisihController::class, 'reject'])->name('selisih.reject');
    Route::put('selisih/approve/{selisih:docnum}', [SelisihController::class, 'approve'])->name('selisih.approve');
    Route::get('selisih/edit/{selisih:docnum}', [SelisihController::class, 'edit'])->name('selisih.edit');
    Route::put('selisih/update/{selisih:docnum}', [SelisihController::class, 'update'])->name('selisih.update');

    // Feedback
    Route::get('feedbacks', [FeedbackController::class, 'index'])->name('feedbacks');
    Route::post('feedbacks/store', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::get('chat/{feedback:feedback_docnum}', [ChatController::class, 'index'])->name('chat');
    Route::post('chat/{feedback:feedback_docnum}', [ChatController::class, 'store'])->name('chat.store');
    Route::put('chat/close/{feedback:feedback_docnum}', [FeedbackController::class, 'close'])->name('feedback.close');

    // Plant Management
    Route::get('plants', [PlantController::class, 'index'])->name('plants');
    Route::get('plant/create', [PlantController::class, 'create'])->name('plant.create');
    Route::post('plant/store', [PlantController::class, 'store'])->name('plant.store');
    Route::get('plant/edit/{plant}', [PlantController::class, 'edit'])->name('plant.edit');
    
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

    // Reports
    Route::get('reports', [ReportController::class, 'index'])->name('reports');
    Route::get('itemlist-report', [ReportController::class, 'itemList'])->name('itemlist-report');
    Route::get('itemlist-report/print-pdf', [ReportController::class, 'itemList_print_pdf'])->name('itemlist-report.print-pdf');
    Route::get('itemlist-report/export-excel', [ReportController::class, 'exportToExcelItemList'])->name('itemlist-report.export-excel');
    Route::get('userlist-report', [ReportController::class, 'userList'])->name('userlist-report');
    Route::get('userlist-report/print-pdf', [ReportController::class, 'userList_print_pdf'])->name('userlist-report.print-pdf');
    Route::get('userlist-report/export-excel', [ReportController::class, 'exportToExcelUserList'])->name('userlist-report.export-excel');
    Route::get('bm-bydate-report', [ReportController::class, 'BMByDate'])->name('bm-bydate-report');
    Route::get('bm-bydate-report/print-pdf', [ReportController::class, 'BMByDate_print_pdf'])->name('bm-bydate-report.print-pdf');
    Route::get('bm-bydate-report/export-excel', [ReportController::class, 'exportToExcelBMByDate'])->name('bm-bydate-report.export-excel');
    Route::get('permintaan-bydate-report', [ReportController::class, 'PermintaanByDate'])->name('permintaan-bydate-report');
    Route::get('permintaan-bydate-report/print-pdf', [ReportController::class, 'PermintaanByDate_print_pdf'])->name('permintaan-bydate-report.print-pdf');
    Route::get('permintaan-bydate-report/export-excel', [ReportController::class, 'exportToExcelPermintaanByDate'])->name('permintaan-bydate-report.export-excel');
    Route::get('permintaan-byreq-report', [ReportController::class, 'PermintaanByReq'])->name('permintaan-byreq-report');
    Route::get('permintaan-byreq-report/print-pdf', [ReportController::class, 'PermintaanByReq_print_pdf'])->name('permintaan-byreq-report.print-pdf');
    Route::get('permintaan-byreq-report/export-excel', [ReportController::class, 'exportToExcelPermintaanByReq'])->name('permintaan-byreq-report.export-excel');
    Route::get('pengeluaran-bydate-report', [ReportController::class, 'PengeluaranByDate'])->name('pengeluaran-bydate-report');
    Route::get('pengeluaran-bydate-report/print-pdf', [ReportController::class, 'PengeluaranByDate_print_pdf'])->name('pengeluaran-bydate-report.print-pdf');
    Route::get('pengeluaran-bydate-report/export-excel', [ReportController::class, 'exportToExcelPengeluaranByDate'])->name('pengeluaran-bydate-report.export-excel');
    Route::get('pengeluaran-byreq-report', [ReportController::class, 'PengeluaranByReq'])->name('pengeluaran-byreq-report');
    Route::get('pengeluaran-byreq-report/print-pdf', [ReportController::class, 'PengeluaranByReq_print_pdf'])->name('pengeluaran-byreq-report.print-pdf');
    Route::get('pengeluaran-byreq-report/export-excel', [ReportController::class, 'exportToExcelPengeluaranByReq'])->name('pengeluaran-byreq-report.export-excel');
    Route::get('selisih-bydate-report', [ReportController::class, 'SelisihByDate'])->name('selisih-bydate-report');
    Route::get('selisih-bydate-report/print-pdf', [ReportController::class, 'SelisihByDate_print_pdf'])->name('selisih-bydate-report.print-pdf');
    Route::get('selisih-bydate-report/export-excel', [ReportController::class, 'exportToExcelSelisihByDate'])->name('selisih-bydate-report.export-excel');
    Route::get('minimumqty-report', [ReportController::class, 'minimumQty'])->name('minimumqty-report');
    Route::get('minimumqty-report/export-excel', [ReportController::class, 'exportToExcelMinimumQty'])->name('minimumqty-report.export-excel');
    Route::get('movingavg-report', [ReportController::class, 'movingAvg'])->name('movingavg-report');
    Route::get('movingavg-report/export-excel', [ReportController::class, 'exportToExcelMovingAvg'])->name('movingavg-report.export-excel');
    Route::get('inventoryinwhs-report', [ReportController::class, 'inventoryInWhs'])->name('inventoryinwhs-report');
    Route::get('movingavg-byitem-report', [ReportController::class, 'movingAvgByItem'])->name('movingavg-byitem-report');
    Route::get('movingavg-byitem-report/export-excel', [ReportController::class, 'exportToExcelMovingAvgByItem'])->name('movingavg-byitem-report.export-excel');
});
