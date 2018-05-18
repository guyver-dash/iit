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
        $user = $user->with('roles')->first();
        $roles = $user->roles()->pluck('name');
        $myRoles = $user->roles()->pluck('roles.id');
        return response()->json([
                'token' => $token,
                'user' => $user,
                'roles' => $roles,
                'myRoles' => $myRoles
            ]);
	}

	public function getAuthUser($request){
        
        $user = JWTAuth::toUser($request->token)->with('roles')->first();
        $user = $user->with('roles')->first();
        $roles = $user->roles()->pluck('name');
        $myRoles = $user->roles()->pluck('roles.id');
        return response()->json(['user' => $user, 'roles' => $roles, 'myRoles' => $myRoles]);
    }

    public function logout($request){

        JWTAuth::setToken($request->token)->invalidate();
        return response()->json([
            'result' => 'logout',
            ]);
    }

    public function profileUpdate($request){

         $user = JWTAuth::toUser($request->token);
         $user->roles()->sync($request->roles);

         if( $request->user['password'] != ''){
            $user->password = Hash::make($request->user['password']);
         }
         $user->firstname = $request->user['firstname'];
         $user->lastname = $request->user['lastname'];
         $user->email = $request->user['email'];
         $user->update();

         return response()->json($user);

        


    }

    

	
}