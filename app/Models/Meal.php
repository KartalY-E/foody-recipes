<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class Meal extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function isFav()
    {
        $x = Favorite::where('meal_id', '=', $this->id)->where('user_id', '=', Auth::id())->get()->count();
        if ($x == 0) {
            return 'false';
        } else {
            return 'true';
        }
    }
}
