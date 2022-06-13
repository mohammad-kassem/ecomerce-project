<?php

namespace App\Http\Controllers\User;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;


use App\HTTP\Controllers\Controller;


class ProductController extends Controller{
    public function getAllProducts(Request $request){
        $token = auth('api')->check();
        if ($token){
            $user = (auth('api')->user());
            $user_id= $user->id;
        }
        else $user_id = 0;
        $products = Product::with(['users'=>function($querry) use ($user_id){
            $querry->where('user_id',$user_id);
        }])->with('category')->get();
        return response()->json([
            'status' => 'Success',
            'products' => $products
        ], 200);
    }
}
