<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
class AuthController extends Controller
{

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'unique:users|required|email',
            'password'=>'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error',$validator->errors());
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
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('Test')->plainTextToken;
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return $this->sendError("Unauthorised",['error'=>'Unauthorised']);
        }
    }

    public function logout()
    {
    Auth::guard('api')->logout();

    return $this->sendResponse([], 'User logged off successfully.');
    }

    //
    public function sendResponse($result, $message){

    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */

    public function sendError($error, $errorMessages = [], $code = 404){

    	$response = [
            'success' => false,
            'message' => $error,

        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

}
