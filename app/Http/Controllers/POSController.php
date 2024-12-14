<?php

namespace App\Http\Controllers;

use App\Models\SuccessOrder;
use App\Models\successOrderMeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class POSController extends Controller
{
    public function store(Request $request)
    {
        $invoiceNo = 'INV-' . now()->format('Ymd') . '-' . rand(1000, 9999);

        // Create SuccessOrder record
        $successOrder = SuccessOrder::create([
            'invoice_no' => $invoiceNo,
            'total_amount' => $request['total'],
            'tender' => $request['tenderAmount'],
            'change' => $request['change'],
            'paymentMethod' => $request['paymentMethod'],
            'orderType' => $request['orderType'],
            'isDiscounted' => $request['applyDiscount'],
            'reference_number' => $request['gcashReference']
        ]);

        if ($successOrder) {
            // // Loop through the orders array and save each order in SuccessOrderMeal
            foreach ($request['orders'] as $order) {
                successOrderMeal::create([
                    'success_order_id' => $successOrder->id, // Foreign key reference
                    'meal_id' => $order['meal_id'],
                    'quantity' => $order['quantity'],
                ]);
            }
        }

        return response()->json([
            'status' => 200,
            'invoice_no' => $invoiceNo,
            'successOrder' => $successOrder,
            'message' => 'Order and meals saved successfully'
        ]);
    }
}
