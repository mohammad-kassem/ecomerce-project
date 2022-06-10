<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

use App\HTTP\Controllers\Controller;


class ProductController extends Controller{
    public function getAllProducts($user_id){
        // $products = Product::get();
        // foreach ($products as $product) {
        //     $product = $product->users->where("id", 2);
        //     foreach($product as $x){
        //     echo $x->pivot->user_id->with('Products');
        //     }
        // }
        $products = Product::with(['users'=>function($querry) use ($user_id){
            $querry->where('user_id',$user_id);
        }])->get();
        return response()->json([
            "status" => "Success",
            "products" => $products
        ], 200);
    }

}
