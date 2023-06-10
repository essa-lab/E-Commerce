<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class CategoryController extends ApiController
{

    public function getAllCategories(){
        try{

        $category = Category::all();
        return  $this->sendResponse($category,'Category retrived',Response::HTTP_OK);

        }catch(\Exception $e){

            return $this->sendErrorResponse('Error in retriving category',$e->getMessage(),Response::HTTP_NOT_FOUND);

        }
    }

}
