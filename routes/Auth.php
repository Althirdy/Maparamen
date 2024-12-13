<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::inertia('/login', 'Auth/Login')->middleware('guest')->name('home.login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
