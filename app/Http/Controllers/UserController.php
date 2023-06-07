<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function getUser()
    {
        $user = Auth::user();
        return response()->json($user);
    }
    public function isAdmin()
    {
        $user = Auth::user();
        $isAdmin =  $user->is_admin ;

        return response()->json(['is_admin' => $isAdmin]);
    }
    public function index(){
        $users = User::all();

        return response()->json($users);
    }
}
