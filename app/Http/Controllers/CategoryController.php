<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{

    public function getAllCategories(){
        $category = Category::all();

        return  response()->json($category);
    }

}
