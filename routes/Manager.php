<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\Manager\CrewController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VoiBadController;
use App\Models\InventoryCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'nocache'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('Manager.Dashboard');
    });
    Route::get('/dashboard/{daily_date?}', [ReportController::class, 'ManagerDashboard'])->name('Manager.Dashboard');
    Route::inertia('/pos', 'Manager/Pos')->name('Manager.Pos');
    Route::inertia('/profile', 'Manager/Profile')->name('profile');
    Route::get('/bad_order', [VoiBadController::class, 'index'])->name('Manager.BadOrder');
    Route::get('/manage_crew', [CrewController::class, 'index'])->name('Manager.Crew_manager');
    Route::post('/manage_crew', [CrewController::class, 'store'])->name('crew.store');
    Route::post('/destroy_crew', [CrewController::class, 'destroy'])->name('crew.destroy');
    Route::inertia('/payment', 'Manager/PaymentPage')->name('Manager.Payment');
    Route::get('/void_order', [VoiBadController::class, 'void'])->name('Manager.VoidOrder');
    Route::post('/update_void', [VoiBadController::class, 'updateVoidItem'])->name('Update.VoidOrder');
    Route::get('/get_invoice', [VoiBadController::class, 'GetInvoice'])->name('Get.Invoice');
    Route::post('/getInvoiceInfo', [VoiBadController::class, 'getInvoiceInfo'])->name('Get.InvoiceInfo');
    Route::post('/store_bad_order', [VoiBadController::class, 'storeBadOrder'])->name('store.BadOrder');
    Route::get('/inventory/{category_id?}/{searchQuery?}', [InventoryController::class, 'ingredients'])->name('inventory.ingredients');
    Route::get('/get_procurement/{query?}', [InventoryController::class, 'procurement'])->name('inventory.procurement');
    Route::post('/store_delivery', [InventoryController::class, 'store_delivery'])->name('inventory.store.procurement');
    Route::get('/get_delivery/{status?}/{query?}', [InventoryController::class, 'get_delivery'])->name('inventory.get.delivery');
    Route::post('/receive_delivery', [InventoryController::class, 'receive_delivery'])->name('inventory.receive.delivery');
    Route::post('/complete_delivery', [InventoryController::class, 'complete_delivery'])->name('inventory.complete.delivery');
    Route::post('/store_return', [InventoryController::class, 'store_return'])->name('inventory.store.return');
    Route::get('/get_return', [InventoryController::class, 'get_return'])->name('intenvory.get.return');
    Route::post('/update_stock', [InventoryController::class, 'update_stock'])->name('inventory.update.stock');
    Route::post('/store_ingredient', [InventoryController::class, 'store'])->name('inventory.store.ingredient');
    Route::get('/Inventory_Summary/{query?}',[ReportController::class,'Inventory_Summary'])->name('report.inventory_summary');
    Route::post('/update_info',[AuthController::class,'Update_Profile'])->name('Update_Profile');
    Route::post('/update_password',[AuthController::class,'update_password'])->name('update_password');
    Route::post('/inactive_crew',[AuthController::class,'inactive_crew'])->name('inactive_crew');
    Route::get('/get_active_crew',[ReportController::class,'active_crew'])->name('get_active_crew');
    Route::get('/get_notification',[ReportController::class,'get_notification'])->name('get_notification');
});
Route::get('/daily_reports_pdf', [ReportController::class, 'generateDailyREport'])->name('Manager.report');
