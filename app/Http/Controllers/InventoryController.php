<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB; 

class InventoryController extends Controller
{
    public function inventory(){
        return Inertia::render('Manager/Inventory/Ingredients');
    }
}
