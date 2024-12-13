<?php

use App\Http\Controllers\MealController;
use Illuminate\Support\Facades\Route;

Route::get('/meal_categories', [MealController::class, 'index'])->name('meal.meal_categories')->middleware('auth');
Route::get('/meal/{category_id}',[MealController::class, 'meals'])->name('meal.meal');
Route::post('/void',[MealController::class,'void'])->name('meal.void');
Route::post('/save_void',[MealController::class, 'saveVoidItem'])->name('meal.save_void');
