<?php

use App\Http\Controllers\Manager\CrewController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VoiBadController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'nocache'])->group(function () {
    Route::get('/',[ReportController::class,'ManagerDashboard'])->name('Manager.Dashboard');
    Route::inertia('/pos', 'Manager/Pos')->name('Manager.Pos');
    Route::get('/bad_order', [VoiBadController::class, 'index'])->name('Manager.BadOrder');
    Route::get('/manage_crew', [CrewController::class, 'index'])->name('Manager.Crew_manager');
    Route::post('/manage_crew', [CrewController::class, 'store'])->name('crew.store');
    Route::post('/destroy_crew',[CrewController::class, 'destroy'])->name('crew.destroy');
    Route::inertia('/payment','Manager/PaymentPage')->name('Manager.Payment');
    Route::get('/void_order',[VoiBadController::class,'void'])->name('Manager.VoidOrder');
});
Route::get('/daily_reports_pdf',[ReportController::class,'generateDailyREport'])->name('Manager.report');
// Route::get('/void_items',[VoiBadController::class,'getVoidItems'])->name('Manager.GetVoid');
