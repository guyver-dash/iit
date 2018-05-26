<?php

namespace App\Http\Middleware;
use JWTAuth;
use JWTAuthException;
use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$params)
    {

        $request = app()->make('request');

        $user = JWTAuth::toUser($request->token)->with('roles')->first();

        $roles = $user->roles->pluck('name');

        foreach ($params as $value) {
            
            if( ! in_array($value, $roles->toArray()) ){

                return response()->json([

                        'message' => 'Access Denied!'
                    ]);
            }
        }


        return $next($request);
    }
}
