<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    //get feature product with rate above 4.0
    public function featureProducts(){
        $featuredProducts = Product::with('rating')
        ->whereHas('rating', function ($query) {
            $query->where('rate', '>', 4.0);
        })
        ->get();

         return $featuredProducts;

    }
    public function getProductById(Request $request, $id){
        $product = Product::find($id);

        return response()->json($product);
    }
    //get all  products with paginated functionallity
    public function paginatedProducts(){
            $products = Product::paginate(5);

            return response()->json($products);
        }
    public function getProductsByCategory(Request $request, $id){
        $products = Product::where('category_id', $id)->get();
        return response()->json($products);
    }

}
