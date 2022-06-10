<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JWT\JWTController;
use App\Http\Controllers\User\ProductController;


Route::group(['prefix' => 'v1'], function(){
    Route::group(['prefix' => 'user'], function(){
        Route::post('/register', [JWTController::class, 'register']);
        Route::post('/login', [JWTController::class, 'login']);
        Route::group(['middleware' => 'api'], function($router) {
            Route::post('/refresh', [JWTController::class, 'refresh']);
            Route::post('/logout', [JWTController::class, 'logout']);
        });
    });

    Route::group(['prefix' => 'product'], function(){
        Route::get('/products', [ProductController::class, 'getALLproducts']);
        Route::group(['middleware' => 'api'], function($router) {
            Route::post('/like_product', [JWTController::class, 'likeProduct']);
        });
    });

    Route::group(['prefix' => 'admin'], function(){
        Route::group(['middleware' => 'admin'], function($router) {
        };
    });
});