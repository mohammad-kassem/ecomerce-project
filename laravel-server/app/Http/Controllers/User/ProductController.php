<?php

namespace App\Http\Controllers\User;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

use App\HTTP\Controllers\Controller;


class ProductController extends Controller{
    // public function __construct(){
    //     $this->middleware('auth:api');
    // }
    
    public function getAllProducts(Request $request){
        
        // $products = Product::get();
        // foreach ($products as $product) {
        //     $product = $product->users->select("product_name", "user_id")->get();
        //     echo($product);
        //     foreach($product as $x){
        //         echo $x->likes->select('user_id')->get();
        //     }
        // }
        $token = auth('api')->check();
        if ($token){
            $user = (auth('api')->user());
            $user_id= $user->id;
        }
        else $user_id = 0;
        $products = Product::with(['users'=>function($querry) use ($user_id){
            $querry->where('user_id',$user_id);
        }])->get();
        return response()->json([
            "status" => "Success",
            "products" => $products
        ], 200);
    }
}
