<?php

namespace App\Http\Controllers\API\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\User\UserInterface;

class UserController extends Controller
{
    private $user;

    public function __construct(UserInterface $user){
        $this->user = $user;
    }
   
    public function register(Request $request){

        $user = $this->user->create($request);
        return response()->json(['status'=>true,'message'=>'User created successfully','data'=>$user]);
    }
    
    public function login(Request $request){
       
       return $this->user->login($request);
    }
    public function getAuthUser(Request $request){

       
       return $this->user->getAuthUser($request);
    }
    public function logout(Request $request){

       return $this->user->logout($request);
    }
}
