<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

use App\HTTP\Controllers\Controller;


class ProductController extends Controller{
    public function getAllProducts(){
        // $products = Product::get();
        // foreach ($products as $product) {
        //     $product = $product->users->select("product_name", "user_id")->get();
        //     echo($product);
        //     foreach($product as $x){
        //         echo $x->likes->select('user_id')->get();
        //     }
        // }
        $user = (auth()->user());
        $user_id= $user->id;
        $products = Product::with(['users'=>function($querry) use ($user_id){
            $querry->where('user_id',$user_id);
        }])->get();
        return response()->json([
            "status" => "Success",
            "products" => $products
        ], 200);
    }

}
