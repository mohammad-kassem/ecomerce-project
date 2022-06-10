<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware{
    public function handle(Request $request, Closure $next){
        $user = auth()->user();
        if($user && $user->role_id == 1 ){
            return $next($request);
        }

        return response()->json([
            "status" => "Failure",
            "message" => "Unauthorized"
        ], 40);
    }
}
