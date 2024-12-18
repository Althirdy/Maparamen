<?php

namespace App\Http\Controllers;

use App\Models\Procurement;
use App\Models\SuccessOrder;
use App\Models\successOrderMeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class POSController extends Controller
{
    private $mealIngredients = [
        [
            "meal_id" => 1,
            "ingredients" => [
                ["ingredient_id" => 60, "quantity" => 1],
                ["ingredient_id" => 71, "quantity" => 30],
                ["ingredient_id" => 49, "quantity" => 30],
                ["ingredient_id" => 53, "quantity" => 1],
                ["ingredient_id" => 10, "quantity" => 1],
                ["ingredient_id" => 23, "quantity" => 5],
                ["ingredient_id" => 16, "quantity" => 1],
                ["ingredient_id" => 19, "quantity" => 5],
                ["ingredient_id" => 42, "quantity" => 1],
                ["ingredient_id" => 17, "quantity" => 1],
                ["ingredient_id" => 64, "quantity" => 10]
            ]
        ],
        [
            "meal_id" => 2,
            "ingredients" => [
                ["ingredient_id" => 60, "quantity" => 1],
                ["ingredient_id" => 71, "quantity" => 30],
                ["ingredient_id" => 49, "quantity" => 30],
                ["ingredient_id" => 53, "quantity" => 2],
                ["ingredient_id" => 10, "quantity" => 1],
                ["ingredient_id" => 23, "quantity" => 5],
                ["ingredient_id" => 16, "quantity" => 1],
                ["ingredient_id" => 19, "quantity" => 5],
                ["ingredient_id" => 42, "quantity" => 1],
                ["ingredient_id" => 17, "quantity" => 1],
                ["ingredient_id" => 62, "quantity" => 10]
            ],
        ],
        [
            "meal_id" => 5,
            "ingredients" => [
                ["ingredient_id" => 60, "quantity" => 1],
                ["ingredient_id" => 72, "quantity" => 30],
                ["ingredient_id" => 49, "quantity" => 30],
                ["ingredient_id" => 53, "quantity" => 2],
                ["ingredient_id" => 10, "quantity" => 1],
                ["ingredient_id" => 23, "quantity" => 5],
                ["ingredient_id" => 16, "quantity" => 1],
                ["ingredient_id" => 19, "quantity" => 5],
                ["ingredient_id" => 42, "quantity" => 1],
                ["ingredient_id" => 17, "quantity" => 1],
                ["ingredient_id" => 62, "quantity" => 10],
                ["ingredient_id" => 2, "quantity" => 5]
            ],
        ],
        [
            "meal_id" => 4,
            "ingredients" => [
                ["ingredient_id" => 60, "quantity" => 1],
                ["ingredient_id" => 73, "quantity" => 30],
                ["ingredient_id" => 49, "quantity" => 30],
                ["ingredient_id" => 53, "quantity" => 2],
                ["ingredient_id" => 10, "quantity" => 1],
                ["ingredient_id" => 23, "quantity" => 5],
                ["ingredient_id" => 16, "quantity" => 1],
                ["ingredient_id" => 19, "quantity" => 5],
                ["ingredient_id" => 42, "quantity" => 1],
                ["ingredient_id" => 17, "quantity" => 1],
                ["ingredient_id" => 62, "quantity" => 10]
            ],
        ],
        [
            "meal_id" => 7,
            "ingredients" => [
                ["ingredient_id" => 60, "quantity" => 1],
                ["ingredient_id" => 71, "quantity" => 30],
                ["ingredient_id" => 49, "quantity" => 30],
                ["ingredient_id" => 53, "quantity" => 2],
                ["ingredient_id" => 10, "quantity" => 1],
                ["ingredient_id" => 50, "quantity" => 60],
                ["ingredient_id" => 48, "quantity" => 30],
                ["ingredient_id" => 23, "quantity" => 5],
                ["ingredient_id" => 16, "quantity" => 1],
                ["ingredient_id" => 19, "quantity" => 5],
                ["ingredient_id" => 42, "quantity" => 1],
                ["ingredient_id" => 17, "quantity" => 1],
                ["ingredient_id" => 64, "quantity" => 10]
            ],
        ],
        [
            "meal_id" => 8,
            "ingredients" => [
                ["ingredient_id" => 60, "quantity" => 1],
                ["ingredient_id" => 71, "quantity" => 30],
                ["ingredient_id" => 49, "quantity" => 30],
                ["ingredient_id" => 10, "quantity" => 1],
                ["ingredient_id" => 32, "quantity" => 1],
                ["ingredient_id" => 23, "quantity" => 5],
                ["ingredient_id" => 16, "quantity" => 1],
                ["ingredient_id" => 19, "quantity" => 5],
                ["ingredient_id" => 42, "quantity" => 1],
                ["ingredient_id" => 17, "quantity" => 1],
                ["ingredient_id" => 62, "quantity" => 10]
            ],
        ],
        [
            "meal_id" => 10,
            "ingredients" => [
                ["ingredient_id" => 60, "quantity" => 1],
                ["ingredient_id" => 72, "quantity" => 30],
                ["ingredient_id" => 49, "quantity" => 30],
                ["ingredient_id" => 10, "quantity" => 1],
                ["ingredient_id" => 52, "quantity" => 1],
                ["ingredient_id" => 55, "quantity" => 1],
                ["ingredient_id" => 54, "quantity" => 2],
                ["ingredient_id" => 56, "quantity" => 1],
                ["ingredient_id" => 5, "quantity" => 5],
                ["ingredient_id" => 6, "quantity" => 5],
                ["ingredient_id" => 18, "quantity" => 5],
                ["ingredient_id" => 14, "quantity" => 1],
                ["ingredient_id" => 23, "quantity" => 5],
                ["ingredient_id" => 16, "quantity" => 1],
                ["ingredient_id" => 19, "quantity" => 5],
                ["ingredient_id" => 42, "quantity" => 1],
                ["ingredient_id" => 17, "quantity" => 1],
                ["ingredient_id" => 64, "quantity" => 10]
            ],
        ],
        [
            "meal_id" => 6,
            "ingredients" => [
                ["ingredient_id" => 60, "quantity" => 1],
                ["ingredient_id" => 49, "quantity" => 30],
                ["ingredient_id" => 53, "quantity" => 2],
                ["ingredient_id" => 10, "quantity" => 1],
                ["ingredient_id" => 51, "quantity" => 30],
                ["ingredient_id" => 5, "quantity" => 5],
                ["ingredient_id" => 6, "quantity" => 5],
                ["ingredient_id" => 18, "quantity" => 5],
                ["ingredient_id" => 14, "quantity" => 1],
                ["ingredient_id" => 12, "quantity" => 5],
                ["ingredient_id" => 58, "quantity" => 45],
                ["ingredient_id" => 23, "quantity" => 5],
                ["ingredient_id" => 16, "quantity" => 1],
                ["ingredient_id" => 19, "quantity" => 5],
                ["ingredient_id" => 42, "quantity" => 1],
                ["ingredient_id" => 17, "quantity" => 1],
            ],
        ],
        [
            "meal_id" => 9,
            "ingredients" => [
                ["ingredient_id" => 60, "quantity" => 1],
                ["ingredient_id" => 49, "quantity" => 30],
                ["ingredient_id" => 53, "quantity" => 2],
                ["ingredient_id" => 10, "quantity" => 1],
                ["ingredient_id" => 48, "quantity" => 30],
                ["ingredient_id" => 5, "quantity" => 5],
                ["ingredient_id" => 6, "quantity" => 5],
                ["ingredient_id" => 18, "quantity" => 5],
                ["ingredient_id" => 14, "quantity" => 1],
                ["ingredient_id" => 12, "quantity" => 5],
                ["ingredient_id" => 61, "quantity" => 5],
                ["ingredient_id" => 23, "quantity" => 5],
                ["ingredient_id" => 16, "quantity" => 1],
                ["ingredient_id" => 19, "quantity" => 5],
                ["ingredient_id" => 42, "quantity" => 1],
                ["ingredient_id" => 17, "quantity" => 1],
                ["ingredient_id" => 46, "quantity" => 1]
            ],
        ],
        [
            "meal_id" => 3,
            "ingredients" => [
                ["ingredient_id" => 60, "quantity" => 1],
                ["ingredient_id" => 73, "quantity" => 30],
                ["ingredient_id" => 49, "quantity" => 30],
                ["ingredient_id" => 10, "quantity" => 1],
                ["ingredient_id" => 5, "quantity" => 5],
                ["ingredient_id" => 6, "quantity" => 5],
                ["ingredient_id" => 18, "quantity" => 5],
                ["ingredient_id" => 57, "quantity" => 5],
                ["ingredient_id" => 23, "quantity" => 5],
                ["ingredient_id" => 16, "quantity" => 1],
                ["ingredient_id" => 19, "quantity" => 5],
                ["ingredient_id" => 42, "quantity" => 1],
                ["ingredient_id" => 17, "quantity" => 1],
            ],
        ],
        [
            "meal_id" => 29,
            "ingredients" => [
                ["ingredient_id" => 25, "quantity" => 1],
                ["ingredient_id" => 26, "quantity" => 1],
                ["ingredient_id" => 8, "quantity" => 50],
                ["ingredient_id" => 27, "quantity" => 30],
                ["ingredient_id" => 65, "quantity" => 30],
                ["ingredient_id" => 42, "quantity" => 1],
                ["ingredient_id" => 63, "quantity" => 10]
            ],
        ],
        [
            "meal_id" => 28,
            "ingredients" => [
                ["ingredient_id" => 25, "quantity" => 1],
                ["ingredient_id" => 28, "quantity" => 1],
                ["ingredient_id" => 66, "quantity" => 30],
                ["ingredient_id" => 10, "quantity" => 1],
                ["ingredient_id" => 29, "quantity" => 60],
                ["ingredient_id" => 18, "quantity" => 5],
                ["ingredient_id" => 2, "quantity" => 5],
                ["ingredient_id" => 1, "quantity" => 1],
                ["ingredient_id" => 63, "quantity" => 10]
            ],
        ],
        [
            "meal_id" => 31,
            "ingredients" => [
                ["ingredient_id" => 25, "quantity" => 1],
                ["ingredient_id" => 8, "quantity" => 50],
                ["ingredient_id" => 27, "quantity" => 30],
                ["ingredient_id" => 65, "quantity" => 15],
                ["ingredient_id" => 42, "quantity" => 1],
                ["ingredient_id" => 23, "quantity" => 5],
                ["ingredient_id" => 10, "quantity" => 1],
                ["ingredient_id" => 30, "quantity" => 1],
                ["ingredient_id" => 63, "quantity" => 10]
            ],
        ],
        [
            "meal_id" => 30,
            "ingredients" => [
                ["ingredient_id" => 25, "quantity" => 1],
                ["ingredient_id" => 18, "quantity" => 5],
                ["ingredient_id" => 2, "quantity" => 5],
                ["ingredient_id" => 31, "quantity" => 1],
                ["ingredient_id" => 19, "quantity" => 5],
                ["ingredient_id" => 63, "quantity" => 10]
            ],
        ],
        [
            "meal_id" => 33,
            "ingredients" => [
                ["ingredient_id" => 25, "quantity" => 1],
                ["ingredient_id" => 66, "quantity" => 30],
                ["ingredient_id" => 10, "quantity" => 1],
                ["ingredient_id" => 18, "quantity" => 5],
                ["ingredient_id" => 2, "quantity" => 5],
                ["ingredient_id" => 19, "quantity" => 5],
                ["ingredient_id" => 32, "quantity" => 1],
                ["ingredient_id" => 9, "quantity" => 1],
                ["ingredient_id" => 63, "quantity" => 10]
            ],
        ],
        [
            "meal_id" => 32,
            "ingredients" => [
                ["ingredient_id" => 25, "quantity" => 1],
                ["ingredient_id" => 65, "quantity" => 30],
                ["ingredient_id" => 29, "quantity" => 60],
                ["ingredient_id" => 52, "quantity" => 3],
                ["ingredient_id" => 20, "quantity" => 50],
                ["ingredient_id" => 6, "quantity" => 3],
                ["ingredient_id" => 63, "quantity" => 10]
            ],
        ],
        [
            "meal_id" => 34,
            "ingredients" => [
                ["ingredient_id" => 29, "quantity" => 60],
                ["ingredient_id" => 18, "quantity" => 5],
                ["ingredient_id" => 52, "quantity" => 5],
                ["ingredient_id" => 20, "quantity" => 50],
                ["ingredient_id" => 6, "quantity" => 3],
                ["ingredient_id" => 21, "quantity" => 10],
                ["ingredient_id" => 13, "quantity" => 5],
                ["ingredient_id" => 68, "quantity" => 15],
                ["ingredient_id" => 63, "quantity" => 10]
            ],
        ],
        [
            "meal_id" => 35,
            "ingredients" => [
                ["ingredient_id" => 29, "quantity" => 60],
                ["ingredient_id" => 19, "quantity" => 5],
                ["ingredient_id" => 15, "quantity" => 5],
                ["ingredient_id" => 63, "quantity" => 10],
                ["ingredient_id" => 69, "quantity" => 20]
            ],
        ],
        [
            "meal_id" => 36,
            "ingredients" => [
                ["ingredient_id" => 10, "quantity" => 1],
                ["ingredient_id" => 18, "quantity" => 5],
                ["ingredient_id" => 2, "quantity" => 5],
                ["ingredient_id" => 1, "quantity" => 1],
                ["ingredient_id" => 67, "quantity" => 20],
                ["ingredient_id" => 6, "quantity" => 3],
                ["ingredient_id" => 34, "quantity" => 1],
                ["ingredient_id" => 3, "quantity" => 50],
                ["ingredient_id" => 5, "quantity" => 50],
                ["ingredient_id" => 53, "quantity" => 1]
            ],
        ],
        [
            "meal_id" => 11,
            "ingredients" => [
                ["ingredient_id" => 38, "quantity" => 1],
                ["ingredient_id" => 17, "quantity" => 1],
                ["ingredient_id" => 56, "quantity" => 1],
                ["ingredient_id" => 35, "quantity" => 20],
                ["ingredient_id" => 36, "quantity" => 10],
                ["ingredient_id" => 37, "quantity" => 5],
                ["ingredient_id" => 22, "quantity" => 50],
                ["ingredient_id" => 1, "quantity" => 2],
                ["ingredient_id" => 39, "quantity" => 5],
                ["ingredient_id" => 24, "quantity" => 5]
            ],
        ],
        [
            "meal_id" => 15,
            "ingredients" => [
                ["ingredient_id" => 38, "quantity" => 1],
                ["ingredient_id" => 17, "quantity" => 1],
                ["ingredient_id" => 56, "quantity" => 1],
                ["ingredient_id" => 35, "quantity" => 20],
                ["ingredient_id" => 36, "quantity" => 10],
                ["ingredient_id" => 37, "quantity" => 5],
                ["ingredient_id" => 39, "quantity" => 5],
                ["ingredient_id" => 24, "quantity" => 5],
                ["ingredient_id" => 40, "quantity" => 10]
            ],
        ],
        [
            "meal_id" => 13,
            "ingredients" => [
                ["ingredient_id" => 38, "quantity" => 1],
                ["ingredient_id" => 17, "quantity" => 1],
                ["ingredient_id" => 56, "quantity" => 1],
                ["ingredient_id" => 35, "quantity" => 20],
                ["ingredient_id" => 36, "quantity" => 10],
                ["ingredient_id" => 39, "quantity" => 5],
                ["ingredient_id" => 24, "quantity" => 5],
                ["ingredient_id" => 40, "quantity" => 10],
                ["ingredient_id" => 9, "quantity" => 1],
                ["ingredient_id" => 27, "quantity" => 10],
                ["ingredient_id" => 41, "quantity" => 5]
            ],
        ],
        [
            "meal_id" => 14,
            "ingredients" => [
                ["ingredient_id" => 38, "quantity" => 1],
                ["ingredient_id" => 17, "quantity" => 1],
                ["ingredient_id" => 56, "quantity" => 1],
                ["ingredient_id" => 35, "quantity" => 20],
                ["ingredient_id" => 36, "quantity" => 10],
                ["ingredient_id" => 40, "quantity" => 10],
                ["ingredient_id" => 42, "quantity" => 10],
                ["ingredient_id" => 70, "quantity" => 40]
            ],
        ],
        [
            "meal_id" => 12,
            "ingredients" => [
                ["ingredient_id" => 38, "quantity" => 1],
                ["ingredient_id" => 17, "quantity" => 1],
                ["ingredient_id" => 56, "quantity" => 1],
                ["ingredient_id" => 35, "quantity" => 20],
                ["ingredient_id" => 37, "quantity" => 1],
                ["ingredient_id" => 22, "quantity" => 2],
                ["ingredient_id" => 40, "quantity" => 10],
                ["ingredient_id" => 27, "quantity" => 10],
                ["ingredient_id" => 11, "quantity" => 2],
                ["ingredient_id" => 43, "quantity" => 5]
            ],
        ],
        [
            "meal_id" => 16,
            "ingredients" => [
                ["ingredient_id" => 38, "quantity" => 1],
                ["ingredient_id" => 17, "quantity" => 1],
                ["ingredient_id" => 36, "quantity" => 10],
                ["ingredient_id" => 37, "quantity" => 1],
                ["ingredient_id" => 22, "quantity" => 2],
                ["ingredient_id" => 11, "quantity" => 2],
                ["ingredient_id" => 43, "quantity" => 5],
                ["ingredient_id" => 44, "quantity" => 40],
                ["ingredient_id" => 45, "quantity" => 20],
                ["ingredient_id" => 65, "quantity" => 20]
            ],
        ],
        [
            "meal_id" => 18,
            "ingredients" => [
                ["ingredient_id" => 38, "quantity" => 1],
                ["ingredient_id" => 17, "quantity" => 1],
                ["ingredient_id" => 36, "quantity" => 10],
                ["ingredient_id" => 22, "quantity" => 10],
                ["ingredient_id" => 40, "quantity" => 10],
                ["ingredient_id" => 42, "quantity" => 2],
                ["ingredient_id" => 70, "quantity" => 40],
                ["ingredient_id" => 11, "quantity" => 2],
                ["ingredient_id" => 44, "quantity" => 40]
            ],
        ],
        [
            "meal_id" => 20,
            "ingredients" => [
                ["ingredient_id" => 36, "quantity" => 10],
                ["ingredient_id" => 24, "quantity" => 5],
                ["ingredient_id" => 70, "quantity" => 40],
                ["ingredient_id" => 44, "quantity" => 150],
                ["ingredient_id" => 6, "quantity" => 10],
                ["ingredient_id" => 21, "quantity" => 10],
                ["ingredient_id" => 59, "quantity" => 1],
                ["ingredient_id" => 23, "quantity" => 3]
            ],
        ],
        [
            "meal_id" => 17,
            "ingredients" => [
                ["ingredient_id" => 38, "quantity" => 1],
                ["ingredient_id" => 17, "quantity" => 1],
                ["ingredient_id" => 36, "quantity" => 10],
                ["ingredient_id" => 22, "quantity" => 10],
                ["ingredient_id" => 40, "quantity" => 10],
                ["ingredient_id" => 42, "quantity" => 10],
                ["ingredient_id" => 70, "quantity" => 40],
                ["ingredient_id" => 11, "quantity" => 2],
                ["ingredient_id" => 47, "quantity" => 40]
            ],
        ],
        [
            "meal_id" => 19,
            "ingredients" => [
                ["ingredient_id" => 38, "quantity" => 1],
                ["ingredient_id" => 17, "quantity" => 1],
                ["ingredient_id" => 56, "quantity" => 1],
                ["ingredient_id" => 35, "quantity" => 20],
                ["ingredient_id" => 36, "quantity" => 10],
                ["ingredient_id" => 37, "quantity" => 1],
                ["ingredient_id" => 22, "quantity" => 2],
                ["ingredient_id" => 40, "quantity" => 10],
                ["ingredient_id" => 11, "quantity" => 2],
                ["ingredient_id" => 43, "quantity" => 5],
                ["ingredient_id" => 45, "quantity" => 20],
                ["ingredient_id" => 47, "quantity" => 50]
            ],
        ],
        [
            "meal_id" => 22,
            "ingredients" => [
                ["ingredient_id" => 36, "quantity" => 10],
                ["ingredient_id" => 24, "quantity" => 5],
                ["ingredient_id" => 6, "quantity" => 10],
                ["ingredient_id" => 21, "quantity" => 10],
                ["ingredient_id" => 59, "quantity" => 1],
                ["ingredient_id" => 23, "quantity" => 3],
                ["ingredient_id" => 47, "quantity" => 150]
            ],
        ]
    ];

    public function store(Request $request)
    {
        $invoiceNo = 'INV-' . now()->format('Ymd') . '-' . rand(1000, 9999);
        $user = $request->user();
        DB::beginTransaction();
         try {
            // Create SuccessOrder record
            $successOrder = SuccessOrder::create([
                'invoice_no' => $invoiceNo,
                'crew_id' => $user['id'],
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
                    SuccessOrderMeal::create([
                        'success_order_id' => $successOrder->id, // Foreign key reference
                        'meal_id' => $order['meal_id'],
                        'quantity' => $order['quantity'],
                    ]);
                }
            }

            $matchedMeals = [];
            foreach ($request['orders'] as $order) {
                foreach ($this->mealIngredients as $meal) {
                    if ($order['meal_id'] == $meal['meal_id']) {
                        $matchedMeals[] = $meal['ingredients'];
                        break;
                    }
                }
            }

            $flattenedMeals = array_merge(...$matchedMeals);

            foreach ($flattenedMeals as $ing) {
                if (!isset($ing['ingredient_id']) || !isset($ing['quantity'])) {
                    continue;
                }

                $existingProcurement = Procurement::where('ingredient_id', $ing['ingredient_id'])
                                   ->where('status', 1)
                                   ->first();

                if ($existingProcurement) {
                    // Update the existing procurement record
                    $existingProcurement->quantity += $ing['quantity'];
                    $existingProcurement->save();
                } else {
                    Procurement::create([
                        'ingredient_id' => $ing['ingredient_id'],
                        'quantity' => $ing['quantity']
                    ]);
                }
                Procurement::create([
                    'ingredient_id' => $ing['ingredient_id'],
                    'quantity' => $ing['quantity']
                ]);
               
            }
            // return response()->json([
            //     $flattenedMeals
            // ]);
            DB::commit();
            
            return response()->json([
                'status' => 200,
                'invoice_no' => $invoiceNo,
                'successOrder' => $successOrder,
                'message' => 'Order and meals saved successfully'
            ]);
        } catch (\Exception $e) {
            // DB::rollBack();
            return response()->json(['error' => 'Failed to process the order.'], 500);
        }
    }
}
