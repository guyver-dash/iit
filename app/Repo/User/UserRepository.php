<?php 

namespace App\Repo\User;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Model\User;
use Hash;
use JWTAuth;
use Auth;
use JWTAuthException;
use Uuid;

class UserRepository extends BaseRepository implements UserInterface{

	public function __construct(){

		$this->modelName = new User();
	}

	
	public function create($request){
		
		$requestAll = $request->all();
        $requestAll["uuid"] = Uuid::generate()->string;
		$requestAll["password"] = Hash::make($request->input('password'));
		return $this->modelName->create($requestAll);
	}

	public function login($request){

		$credentials = $request->only('email', 'password');
        $token = null;
        try {
           if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json('Invalid username or password', 422);
           }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }

        $user = JWTAuth::toUser($token);

        return response()->json([
                'token' => $token,
                'user' => $user
            ]);
	}

	public function getAuthUser($request){
        
        $user = JWTAuth::toUser($request->token);
        
        return response()->json(['user' => $user]);
    }

    public function logout($request){

        JWTAuth::setToken($request->token)->invalidate();
        return response()->json(['result' => 'logout']);
    }

    

	
}