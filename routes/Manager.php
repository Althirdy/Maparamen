<?php

use App\Http\Controllers\Manager\CrewController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'nocache'])->group(function () {
    Route::inertia('/', 'Manager/Dashboard')->name('Manager.Dashboard');
    Route::inertia('/pos', 'Manager/Pos')->name('Manager.Pos');

    Route::get('/manage_crew', [CrewController::class, 'index'])->name('Manager.Crew_manager');
    Route::post('/manage_crew', [CrewController::class, 'store'])->name('crew.store');
    Route::post('/destroy_crew',[CrewController::class, 'destroy'])->name('crew.destroy');
    Route::inertia('/payment','Manager/PaymentPage')->name('Manager.Payment');
});
