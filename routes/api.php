<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/v1'], function() {
    Route::apiResource('/tipos-productos', 'Api\v1\TiposProductosController');
    Route::apiResource('/productos', 'Api\v1\ProductosController');
});
