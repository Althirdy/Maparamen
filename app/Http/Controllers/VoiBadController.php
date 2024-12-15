<?php

namespace App\Http\Controllers;

use App\Models\BadOrder;
use App\Models\SuccessOrder;
use App\Models\Void_Order;
use Carbon\Carbon;
use Dompdf\Css\Content\Attr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class VoiBadController extends Controller
{
    public function index()
    {
        $today = Carbon::today();  // This gives today's date at 00:00:00

        if (Auth::user()->role == 1) {
            $badOrders = DB::table('bad_orders as bo')
                ->join('users as u', 'bo.crew_id', '=', 'u.id') // Assuming user_id is the foreign key in bad_orders
                ->select('bo.invoice_no', 'bo.meal_name', 'bo.quantity', 'bo.price', 'bo.status', 'bo.return_reason', 'u.name')
                ->whereDate('bo.created_at','=',$today)
                ->get();
        } else if (Auth::user()->role == 2) {
            $badOrders = DB::table('bad_orders as bo')
                ->join('users as u', 'bo.crew_id', '=', 'u.id') // Assuming user_id is the foreign key in bad_orders
                ->select('bo.invoice_no', 'bo.meal_name', 'bo.quantity', 'bo.price', 'bo.status', 'bo.return_reason', 'u.name')
                ->where('bo.crew_id', '=', Auth::user()->id)
                ->whereDate('bo.created_at','=',$today)
                ->get();
        }

        return Inertia::render('Manager/BadOrder', ['badorders' => $badOrders]);
    }

    public function void()
    {
        $today = Carbon::today();

        if (Auth::user()->role == 1) {
            $void_orders = Void_Order::with('meals')->with('users')
                ->whereDate('created_at',$today)
                // ->orderBy('status', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();
        } else if (Auth::user()->role == 2) {
            $void_orders = Void_Order::with('meals')->with('users')
                ->where('crew_id', Auth::user()->id) // Use a comma, not '='
                ->orderBy('created_at', 'desc')
                ->whereDate('created_at',$today)
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

    public function updateVoidItem(Request $request)
    {

        $voidOrder = Void_Order::find($request['id']);
        if ($voidOrder) {
            $voidOrder->status = 2;
            $voidOrder->save();
            return response()->json(['status' => 200]);
        }
    }


    public function storeBadOrder(Request $request)
    {
        $saveBadOrder = BadOrder::create([
            'invoice_no' => $request['invoice'],
            'meal_id' => $request['meal_id'],
            'crew_id' => Auth::user()->id,
            'meal_name' => $request['meal_name'],
            'quantity' => $request['quantity'],
            'price' => $request['price'],
            'status' => $request['status'],
            'return_reason' => $request['reason']
        ]);

        if ($saveBadOrder) {
            return response()->json(['status' => 200, 'message' => 'BadOrder Saved']);
        }
    }



    public function GetInvoice()
    {
        // Get today's start and end timestamps
        $today = Carbon::today();  // This gives today's date at 00:00:00

        // Fetch invoices where created_at is today (between start and end of the day)
        $invoices = SuccessOrder::select('id', 'invoice_no', 'total_amount')
            ->whereDate('created_at', $today)  // Filter by today's date range
            ->get();

        // Return the data as a JSON response
        return response()->json($invoices);
    }



    public function getInvoiceInfo(Request $request)
    {

        // Validate the request to ensure invoice_no is provided
        // $validated = $request->validate([
        //     'invoice_no' => 'required|string|exists:success_orders,invoice_no',
        // ]);

        // Get today's date
        $today = Carbon::today();

        // Run a raw query to fetch the invoice information along with the meals for the given invoice_no and today's date
        $invoices = DB::table('success_orders as so')
            ->join('success_order_meals as som', 'so.id', '=', 'som.success_order_id')
            ->join('meals as m', 'som.meal_id', '=', 'm.id')
            ->select('so.id as order_id', 'so.invoice_no', 'so.total_amount', 'm.id as meal_id', 'm.meal_name as meal_name', 'm.meal_price', 'som.quantity')
            ->where('so.invoice_no', $request['invoice_no'])
            ->whereDate('so.created_at', $today)  // Filter by today's date
            ->get();

        if ($invoices->isEmpty()) {
            return response()->json(['message' => 'Invoice not found.'], 200);
        }

        // Group the meals by order_id, with each order having its corresponding meals array
        $groupedInvoice = $invoices->groupBy('order_id')->map(function ($order) {
            return [
                'invoice_no' => $order[0]->invoice_no,
                'total_amount' => $order[0]->total_amount,
                'meals' => $order->map(function ($meal) {
                    return [
                        'meal_id' => $meal->meal_id,
                        'meal_name' => $meal->meal_name,
                        'price' => $meal->meal_price,
                        'quantity' => $meal->quantity, // Add quantity to the meal data
                    ];
                })->toArray()
            ];
        });

        // Return all grouped invoices (in case multiple orders are found)
        return response()->json($groupedInvoice->values()->all());
    }
}
