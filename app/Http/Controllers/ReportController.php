<?php

namespace App\Http\Controllers;

use App\Models\Ingredients;
use App\Models\returnIngredients;
use App\Models\SuccessOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ReportController extends Controller
{

    public function ManagerDashboard($daily_date = null)
    {
        if (Auth::user()->role !== 1) {
            return back();
        }

        $today = Carbon::now();
        $startOfWeek = Carbon::now()->subDays(7)->startOfDay();
        $endOfWeek = $today->endOfDay();

        $monthlySales = DB::table('success_orders')
            ->whereMonth('created_at', $today->month)
            ->whereYear('created_at', $today->year)
            ->sum('total_amount');

        $weeklySales = DB::table('success_orders')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->sum('total_amount');

        $dailyDate = $today->toDateString();  // Default to today

        if ($daily_date) {
            try {
                $dailyDate = Carbon::parse($daily_date)->toDateString();
            } catch (\Exception $e) {
                return back();
            }
        }

        // Daily sales (use the $daily_date if valid, otherwise default to today)
        $dailySales = DB::table('success_orders')
            ->whereDate('created_at', $dailyDate)
            ->sum('total_amount');

        return Inertia::render('Manager/Dashboard', [
            'monthlySales' => $monthlySales,
            'weeklySales' => $weeklySales,
            'dailySales' => $dailySales,
            'daily_date' => $daily_date
        ]);
    }

    public function generateDailyREport(Request $request)
    {
        // Get today's date
        $today = $request->query('date', Carbon::today()->toDateString());

        // Fetch all success orders created today
        $successOrders = DB::table('success_orders')
            ->join('users', 'success_orders.crew_id', '=', 'users.id')
            ->select(
                'success_orders.id as success_order_id',
                'success_orders.invoice_no',
                'success_orders.total_amount',
                'success_orders.tender',
                'success_orders.change',
                'success_orders.paymentMethod',
                'success_orders.reference_number',
                'success_orders.orderType',
                'success_orders.isDiscounted',
                'success_orders.created_at',
                'users.id as user_id',
                'users.name as user_name',
                'users.crew_id as crew_id'
            )
            ->whereDate('success_orders.created_at', $today)
            ->get();

        // Fetch all success order meals and group them by success_order_id
        $successOrderMeals = DB::table('success_order_meals')
            ->join('meals', 'success_order_meals.meal_id', '=', 'meals.id')
            ->select(
                'success_order_meals.success_order_id',
                'success_order_meals.id as success_order_meal_id',
                'meals.meal_name',
                'meals.meal_price',
                'success_order_meals.quantity'
            )
            ->get()
            ->groupBy('success_order_id');

        // Format the response
        $response = $successOrders->map(function ($order) use ($successOrderMeals) {
            return [
                'successOrder' => [
                    'id' => $order->success_order_id,
                    'invoice_no' => $order->invoice_no,
                    'total_amount' => $order->total_amount,
                    'tender' => $order->tender,
                    'change' => $order->change,
                    'paymentMethod' => $order->paymentMethod,
                    'reference_number' => $order->reference_number,
                    'orderType' => $order->orderType,
                    'isDiscounted' => $order->isDiscounted,
                    'created_at' => $order->created_at,
                ],
                'success_order_meal' => $successOrderMeals->get($order->success_order_id)?->map(function ($meal) {
                    return [
                        'meal_name' => $meal->meal_name,
                        'meal_price' => $meal->meal_price,
                        'quantity' => $meal->quantity,
                    ];
                })->toArray() ?? [],
                'user' => [
                    'id' => $order->user_id,
                    'name' => $order->user_name,
                    'crew_id' => $order->crew_id,
                ],
            ];
        })->toArray();

        // $data = ['data' => $response->toArray()];

        $pdf = Pdf::loadView('success_orders', ['data' => $response, 'selectedDate' =>  $today]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream('success_orders_report.pdf');
        // return response()->json($response);
    }


    public function Inventory_Summary($query = null)
    {
        if ($query) {
            $inventory = Ingredients::where('ingredient_name', 'like', "%{$query}%")
                ->inRandomOrder() // Randomize the results
                ->take(5)          // Limit to 4 records
                ->get();
        } else {
            // If no query, get 4 random records
            $inventory = Ingredients::inRandomOrder()
                ->take(5)
                ->get();
        }
        
        return response()->json($inventory);
    }
}
