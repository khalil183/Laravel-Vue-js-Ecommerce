<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('/category','Admin\Api\CategoryController');
Route::apiResource('/brand','Admin\Api\BrandController');
