<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Meal;
use PhpParser\Node\Stmt\Return_;
use SebastianBergmann\Environment\Console;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    // return home page
    public function index()
    {
        return view('home');
    }

    // return favorites page
    public function favorites()
    {
        return view('favorites');
    }

    // return all user favorites
    public function userFavorites()
    {
        // Getting all meal ids
        $favoriteMeals = Favorite::where('user_id', Auth::id())->pluck('meal_id')->toArray();
        // Getting meals with ids
        $meals = Meal::findMany($favoriteMeals);
        return $meals;
    }

    // check if exist if not create
    public function favoriteToggle(Meal $meal)
    {
        // CHECK
        $check = DB::table('favorites')
            ->where('meal_id', "=", $meal->id)
            ->where('user_id', "=", Auth::id())
            ->get()->count();

        // CREATE a favorite
        if ($check == 0) {
            $x = Favorite::create([
                'meal_id' => $meal->id,
                'user_id' => Auth::id(),
            ]);

            $x->save();
            // DELETE de favorite
        } else {
            $check = Favorite::where([
                'meal_id' => $meal->id,
                'user_id' => Auth::id(),
            ])->delete();
        }
    }

    //  return single meal with 3 random suggested meals 
    public function show(Meal $meal)
    {
        $suggestedMeals = Meal::all()->random(3);
        return view('meal', ['meal' => $meal, 'suggestedMeals' => $suggestedMeals]);
    }
}
