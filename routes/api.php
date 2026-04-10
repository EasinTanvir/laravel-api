<?php

use App\Http\Controllers\Api\V1\Post\PostController;
use App\Http\Controllers\Api\V1\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/user',[UserController::class, "index"])->name("all user");


Route::prefix('v1')->group(function(){

  Route::apiResource("posts", PostController::class);

});