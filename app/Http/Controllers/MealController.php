<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    // Return meal with category search 
    public function searchMealCategory(Request $request)
    {
        if (isset($request->searchCategory)) {
            # code...
            return Meal::where('category_id', '=', $request->searchCategory)->get();
        } else {
            return Meal::where('category_id', '=', 1)->get();
        }
    }

    // return 6 random meals for the home page , axios api 
    public function random()
    {
        return Meal::all()->random(12);
    }

    // return 
    public function searchMeal(Request $request)
    {
        return  Meal::where('name', 'LIKE', "%{$request->search}%")
            ->orWhere('area', 'LIKE', "%{$request->search}%")
            ->limit(20)->get();
    }
}
