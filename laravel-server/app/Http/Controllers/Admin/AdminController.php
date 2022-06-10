<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;

use App\HTTP\Controllers\Controller;


class AdminController extends Controller{

    public function uploadProduct(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
            'price' => 'required',
            'category_id' => 'required|integer',
            'image' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        
        $image = $request->image;
        $imagename= date('YmdHi').$image->getClientOriginalName();
        $image-> move(public_path('/images'), $imagename);
        $image_url = asset('images/' . $imagename);

        $product = Product::create([
            'product_name' => $request->name,
            'price' =>  $request->price,
            'category_id' =>  $request->price,
            'image' => $image_url,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Product added successfully',
            'product' => $product,
        ]);
    }

    public function addCategory(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        
        $category = Category::create([
            'category_name' => $request->name,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Category added successfully',
            'category' => $category,
        ]);
    }
}




        