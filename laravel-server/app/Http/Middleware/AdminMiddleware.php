<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware{
    public function handle(Request $request, Closure $next){
        $user = auth()->user();
        if($user and $user->role_id == 2 ){
            return $next($request);
        }

        return response()->json([
            "status" => "Failure",
            "message" => "Unauthorized"
        ], 401);
    }
}
