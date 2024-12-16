<?php

namespace App\Http\Controllers;

use App\Models\Ingredients;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InventoryController extends Controller
{
    public function ingredients($category_id = null, $searchQuery = null)
    {
        if ($category_id && !$searchQuery) {
            $ingredients = Ingredients::where('category_id', $category_id)
                ->paginate(10);
            return Inertia::render('Manager/Ingredients', [
                'ingredients' => $ingredients,
                'category_id' => $category_id
            ]);
        } else if ($category_id && $searchQuery) {
            $ingredients = Ingredients::where('category_id', $category_id)->where('ingredient_name', 'like', '%' . $searchQuery . '%')
                ->paginate(10);

            return Inertia::render('Manager/Ingredients', [
                'ingredients' => $ingredients,
                'category_id' => $category_id,
                'searchQuery' => $searchQuery
            ]);
        } else {
            $ingredients = Ingredients::where('category_id', 1)->paginate(10);
            return Inertia::render('Manager/Ingredients', [
                'ingredients' => $ingredients,
                'category_id' => '1' 
            ]);
        }
    }

    // public function filteredIngredients(Request $request)
    // {
    //     $query = Ingredients::query();
    //     if ($request->has('category_id') && $request->category_id) {
    //         $query->where('category_id', $request->category_id);
    //     }

    //     if ($request->has('searchQuery') && $request->searchQuery) {
    //         $query->where('ingredient_name', 'like', '%' . $request->searchQuery . '%');
    //     }

    //     $ingredients = $query->paginate(10);

    //     return response()->json($ingredients);
    // }
}
