<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\HTTP\Response;

class UserController extends ApiController
{
    //
    public function getUser(){
        try{

        $user = Auth::user();
        if(!$user){
            throw new \Exception ();
        }
        return $this->sendResponse($user,'User retrived Successfully',Response::HTTP_OK);
    }catch(\Exception $e){
        return $this->sendErrorResponse('User Not Found!',$e->getMessage(),Response::HTTP_NOT_FOUND);
    }
}
    public function isAdmin()
    {
        try{
        $user = Auth::user();
        if(!$user){
            throw new \Exception();
        }

        $isAdmin =  $user->is_admin ;

        return $this->sendResponse(['isAdmin'=>$isAdmin],'Checked!',Response::HTTP_OK);
        }catch(\Exception $e){
            return $this->sendErrorResponse('User Not Found',$e->getMessage(),Response::HTTP_NOT_FOUND);
        }
    }
    public function index(){
        try{
        $users = User::all();

        return $this->sendResponse($users,"Users Retrived!",Response::HTTP_OK);

        }catch(\Exception $e){
            return $this->sendErrorResponse('Model Not Found',$e->getMessage(),Response::HTTP_NOT_FOUND);
        }
    }
}
