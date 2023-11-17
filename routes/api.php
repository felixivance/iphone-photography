<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::group(['prefix'=> 'v1'], static function (){
    Route::post('register', [App\Http\Controllers\UserController::class,'userRegistration']);
    Route::post('login', [App\Http\Controllers\UserController::class,'login']);
});

Route::group(['prefix'=> 'v1','middleware' => ['auth:sanctum']], static function (){

});