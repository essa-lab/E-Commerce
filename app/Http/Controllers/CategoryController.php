<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{
    //get all category from the free to use product api
    public function getAllCategories(){
        $category = Category::all();

        return  response()->json($category);
    }
    public function getProductsCategory($categoryName){

    $response = Http::get('https://fakestoreapi.com/products/');
    $products = $response->json();

    $filteredProducts = array_filter($products, function ($product) use ($categoryName) {
        return $product['category'] == $categoryName;
        });

    $reformattedData = array_values($filteredProducts);

    $reformattedJson = json_encode($reformattedData, JSON_PRETTY_PRINT);
    return $reformattedJson;

    }
}
