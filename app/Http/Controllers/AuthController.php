<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
class AuthController extends ApiController
{

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'unique:users|required|email',
            'password'=>'required',
        ]);
        if($validator->fails()){
            return $this->sendErrorResponse('Validation Error',$validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('Test')->plainTextToken;
        $success['name']=$user->name;

        return $this->sendResponse($success,"User Register Successfully.");


    }

    /**
     * Login api
     * @return \Illuminate\Http\Response
     *
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if($validator->fails()){
            return $this->sendErrorResponse('Validation Error',$validator->errors(),Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('Test')->plainTextToken;
            $success['name'] =  $user->name;
            $success['isAdmin']=$user->is_admin;

            return $this->sendResponse($success, 'User login successfully.',Response::HTTP_OK);
        }
        else{
            return $this->sendErrorResponse("Unauthorised",['error'=>'Unauthorised'],Response::HTTP_UNAUTHORIZED);
        }
    }

    public function logout(){
        try{
            Auth::guard('api')->logout();
            return $this->sendResponse([],'User Logger Off Successfully',Response::HTTP_OK);
        }catch(\Exception $e){
            $this->sendErrorResponse("Logout Faild",$e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
