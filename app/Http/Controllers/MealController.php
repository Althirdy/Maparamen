<?php

namespace App\Http\Controllers;

use App\Models\MealCategory;
use App\Models\Meals;
use App\Models\Void_Order;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function index()
    {
        $categories = MealCategory::select('category', 'id')
            ->withCount('meals')
            ->orderBy('id')
            ->get();

        return response()->json($categories);
    }

    public function meals($category_id)
    {

        if ($category_id != 1) {
            $meals = Meals::with('category:id,category')
                ->select('id', 'meal_name', 'meal_price', 'meal_image', 'category_id')
                ->where('category_id', $category_id)
                ->get();
        } else {
            $meals = Meals::with('category:id,category')
            ->select('id', 'meal_name', 'meal_price', 'meal_image', 'category_id')
            ->get();
        }

        return response()->json($meals);
    }

    public function void(Request $request)
    {
        $validate = $request->validate([
            'passCode' => 'required'
        ]);
        $user = $request->user();

        if ($request['passCode'] === 'password') {
            $void = Void_Order::create([
                'crew_id' => $user['id'],
                'meal_id' => $request['orderDetails']['meal_id'],
                'status' => 2
            ]);
            if ($void) {
                return response()->json([
                    'status' => 200,
                    'message' => 'voided'
                ]);
            }
        }
    }

    public function saveVoidItem(Request $request)
    {
        $user = $request->user();

        $saveVoidItem = Void_Order::create([
            'crew_id' => $user['id'],
            'meal_id' => $request['orderDetails']['meal_id'],
            'status' => 1
        ]);

        if ($saveVoidItem) {
            return response()->json([
                'status' => 200,
                'message' => 'Item Saved'
            ]);
        }
    }
}
