<?php

namespace App\Http\Controllers\JWT;

use Auth;
use Validator;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\HTTP\Controllers\Controller;

class JWTController extends Controller
{
    //Create a new AuthController instance.
    public function __construct(){
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    //Register User
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|min:2|max:255',
            'lname' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()) {
            return response() -> json([
                'status' => 'Failure',
                'message' => $validator->messages()->get('*')]);
        }

        $user = User::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 1
            ]);

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    //login user
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = auth()->user();
        $role = $user->role;

        return $this->respondWithToken($token, $user);
    }

    //refresh token
    public function refresh(){
        return $this->respondWithToken(auth()->refresh());
    }

    //logout user
    public function logout(){
        auth()->logout();
        return response()->json(['message' => 'User successfully logged out.']);
    }

    //like product
    public function likeProduct(Request $request){
        $user = auth()->user();
        // $Json = (json_decode(json_encode($user->products), true));
        $json = json_decode(json_encode($user->products->where('id', $request->id), true));
        if(empty($json)) $user->products()->attach($request->id);
        else $user->products()->detach($request->id);
        
    }

    //Get the token array structure.
    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => $user
        ]);
    }

} 