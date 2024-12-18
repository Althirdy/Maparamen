<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Ingredients;
use App\Models\Procurement;
use App\Models\returnIngredients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use PhpParser\Node\Stmt\Return_;

class InventoryController extends Controller
{
    public function ingredients($category_id = null, $searchQuery = null)
    {

        if ($category_id && !$searchQuery) {
            $ingredients = Ingredients::where('category_id', $category_id)
                ->paginate(10);
            return Inertia::render('Manager/Ingredients', [
                'ingredients' => $ingredients,
                'category_id' => $category_id,
            ]);
        } else if ($category_id && $searchQuery) {
            $ingredients = Ingredients::where('category_id', $category_id)->where('ingredient_name', 'like', '%' . $searchQuery . '%')
                ->paginate(10);

            return Inertia::render('Manager/Ingredients', [
                'ingredients' => $ingredients,
                'category_id' => $category_id,
                'searchQuery' => $searchQuery,

            ]);
        } else {
            $ingredients = Ingredients::where('category_id', 1)->paginate(10);
            return Inertia::render('Manager/Ingredients', [
                'ingredients' => $ingredients,
                'category_id' => '1',
            ]);
        }
    }

    public function procurement($query = null)
    {
        $procurementQuery = Procurement::with('ingredients')
            ->where('status', 1)  // Always filtering by status 1
            ->orderBy('quantity', 'desc');

        if ($query) {
            $procurementQuery->whereHas('ingredients', function ($ingredientQuery) use ($query) {
                $ingredientQuery->where('ingredient_name', 'like', '%' . $query . '%'); // Filtering based on ingredient_name
            });
        }

        // Get procurements with their associated ingredients, paginated
        $procurement = $procurementQuery->paginate(10);

        return response()->json($procurement);
    }

    public function store_delivery(Request $request)
    {
        $procurement_id = $request['proc_id'];
        $delivery_data = $request['delivery_data'];

        $procurement = Procurement::find($procurement_id);

        // Check if the procurement record exists
        if (!$procurement) {
            return response()->json([
                'success' => false,
                'message' => 'Procurement record not found.'
            ], 404);
        }
        $procurement->status = 2;
        $procurement->save();

        $insert_delivery = Delivery::create([
            'order_id' => $delivery_data['order_id'],
            'ingredient_name' => $delivery_data['ingredient_name'],
            'quantity' => $delivery_data['quantity'],
            'measurement' => $delivery_data['measurement'],
            'delivery_date' => $delivery_data['delivery_date'],
        ]);

        if ($insert_delivery) {
            return response()->json([
                'status' => 200,
                'message' => 'Restock successfully'
            ]);
        }
    }

    public function get_delivery($status = null, $query = null)
    {
        // Start the query builder with the user relationship
        $deliveryQuery = Delivery::with('user');

        // Apply the status filter if it's set
        if ($status) {
            $deliveryQuery->where('status', $status);
        }

        // Apply the query filter if it's set
        if ($query) {
            $deliveryQuery->where('ingredient_name', 'like', "%{$query}%");
        }

        // Order by creation date and paginate the results
        $delivery = $deliveryQuery->orderBy('created_at', 'desc')->paginate(10);

        return response()->json($delivery);
    }

    public function receive_delivery(Request $request)
    {
        $delivery_id = $request['delivery_id'];
        $status = $request['status'];
        $crew_id = Auth::user()->id;

        $delivery = Delivery::findOrfail($delivery_id);
        $delivery->update([
            'status' => $status,
            'crew_id' => $crew_id
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Delivery status updated successfully'
        ]);
    }

    public function complete_delivery(Request $request)
    {
        $expiration_date = $request['expiration_date'];
        $manufactured_date = $request['manufactured_date'];
        $delivery_date = $request['delivery_date'];
        $status = $request['status'];
        $id = $request['delivery_id'];

        $delivery = Delivery::find($id);
        if ($delivery) {
            $delivery->expiration_date = $expiration_date;
            $delivery->manufactured_date = $manufactured_date;
            $delivery->delivery_date = $delivery_date;
            $delivery->status = $status;
            $delivery->crew_id = Auth::user()->id;
            $delivery->save();
            return response()->json(['message' => 'Delivery updated successfully!', 'status' => 200]);
        } else {
            return response()->json(['message' => 'Delivery not found!'], 404);
        }
    }

    public function store_return(Request $request)
    {
        $request->validate([
            'return_reason' => 'required|string',
            'remarks' => 'nullable|string'
        ]);

        $return_delivery = Delivery::find($request['delivery_id']);
        if ($return_delivery) {
            $return_delivery->status = 'Returned';
            $return_delivery->save();
            $save_return_item = returnIngredients::create([
                'order_id' => $return_delivery->id,
                'ingredient_name' => $request['ingredient_name'],
                'quantity' => $request['quantity'],
                'measurement' => $request['measurement'],
                'return_date' => $request['return_date'],
                'delivery_date' => $request['delivery_date'],
                'return_reason' => $request['return_reason'],
                'remarks' => $request['remarks']
            ]);
            return response()->json(['status' => 200, 'message' => 'Return Successfully']);
        }
        return response()->json(['status' => 404, 'message' => 'Delivery not found'], 404);
    }

    public function get_return()
    {
        $data = returnIngredients::orderBy('created_at', 'desc')->paginate(10);

        return response()->json($data);
    }
}
