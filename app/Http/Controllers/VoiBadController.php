<?php

namespace App\Http\Controllers;

use App\Models\Void_Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class VoiBadController extends Controller
{
    public function index()
    {

        return Inertia::render('Manager/BadOrder');
    }
    public function void()
    {
        if (Auth::user()->role == 1) {
            $void_orders = Void_Order::with('meals')->with('users')
                ->where('status', 1) // Use a comma, not '='
                ->get();
        } else if (Auth::user()->role == 2) {
            $void_orders = Void_Order::with('meals')->with('users')
                ->where('status', 1)
                ->where('crew_id', Auth::user()->id) // Use a comma, not '='
                ->get();
        }

        return Inertia::render('Manager/VoidOrder', ['void' => $void_orders]);
    }

    // public function getVoidItems()
    // {
    //     $void_orders = Void_Order::with('meals')->with('users')
    //         ->where('status', 1) // Use a comma, not '='
    //         ->get();
    //     return response()->json($void_orders);
    // }

    public function storeBadOrder(Request $request) {}



    public function GetInvoice() {}
}
