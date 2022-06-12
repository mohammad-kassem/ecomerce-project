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

    public function addProduct(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
            'price' => 'required',
            'category_id' => 'required',
            'image' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        
        $image = $request->image;
        $imagename= date('YmdHi').$image->getClientOriginalName();
        $image-> move(public_path('/images'), $imagename);
        $image_url = asset('images/' . $imagename);

    
        $request->name = ucfirst($request->name);
        $product = Product::where('product_name', $request->name)->first();

        if(!$product){
            echo('hi');
            $product = Product::create([
                'product_name' => $request->name,
                'price' =>  $request->price,
                'category_id' =>  $request->category_id,
                'image' => $image_url,
            ]);
        }
        else{
            return response()->json([
            'status' => 'Failure',
            'message' => 'Product already exists',
            'product' => $product,
        ]);

        }

        return response()->json([
            'status' => 'Success',
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

        $request->name = ucfirst($request->name);
        $category = Category::where('category_name', $request->name)->first();
    
        if(!$category){
            $category = Category::create([
                'category_name' => $request->name,
            ]);
        }
        else{  
            return response()->json([
                'status' => 'Failed',
                'message' => 'Category already exists',
                'category' => $category,
            ]);
        }

        return response()->json([
            'status' => 'Success',
            'message' => 'Category added successfully',
            'category' => $category,
        ]);
    }

    public function getCategories(){
        $categories = Category::get();
        return response()->json([
            'status' => 'Success',
            'category' => $categories,
        ]);
    }
}




        