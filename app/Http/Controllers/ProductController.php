<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ProductController extends ApiController
{
    //get feature product with rate above 4.0
    public function featureProducts(){
        try{
        $featuredProducts = Product::with('rating')
        ->whereHas('rating', function ($query) {
            $query->where('rate', '>', 4.0);
        })
        ->get();

         return $this->sendResponse($featuredProducts,'Quereing the data base done!',Response::HTTP_OK);
    }catch(\Exception $e){
        return $this->sendErrorResponse('Failed to retrive feature products',$e->getMessage(),Response::HTTP_NOT_FOUND);
    }
    }
    public function getProductById(Request $request, $id){
        try{
        $product = Product::with('rating')->find($id);

        return $this->sendResponse($product,'Product with'.$id.' retrived successfully!',Response::HTTP_OK);
        }catch(\Exception $e){
            return $this->sendErrorResponse('Failed to retrive products',$e->getMessage(),Response::HTTP_NOT_FOUND);
        }
    }

    //get all  products with paginated functionallity
    public function paginatedProducts(){
        try{
            $products = Product::paginate(5);

            return $this->sendResponse($products,"product retrived successfully!",Response::HTTP_OK);
        }catch(\Exception $e){
            return $this->sendErrorResponse('Failed to retrive products',$e->getMessage(),Response::HTTP_NOT_FOUND);
        }
        }
    public function getProductsByCategory(Request $request, $id){
        try{
        $products = Product::where('category_id', $id)->get();
        return $this->sendResponse($products,'Product Retrive Successfully',Response::HTTP_OK);
        }catch(\Exception $e){
            return $this->sendErrorResponse('Faild to retirve Products!',$e->getMessage(),Response::HTTP_NOT_FOUND);
        }
    }

}
