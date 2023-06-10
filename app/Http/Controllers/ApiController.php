<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class ApiController extends Controller
{
    //
    protected function sendResponse($data, $message=null, $statusCode = Response::HTTP_OK){
        $response= [
            "message"=>$message,
            "data"=>$data
        ];
        return response()->json($response, $statusCode);
    }

    protected function sendErrorResponse ($message,$errors=[], $statusCode){
        $response = [
            'message'=>$message,
            'errors'=>$errors
        ];
        return response()->json($response, $statusCode);
    }

}
