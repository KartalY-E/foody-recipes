<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // return favorites page
    public function index()
    {
        $allCategories = Category::all();
        return view('categories', ['allCategories' => $allCategories]);
    }

    // return favorites page
    public function categories()
    {
        return Category::all();
    }
}
