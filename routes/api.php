<?php

/* use App\Http\Controllers\Api\Admin\AdminLoginController;
use App\Http\Controllers\Api\Admin\AboutController;
use Illuminate\Support\Facades\Route;


Route::post('login',[AdminLoginController::class,'login']);

Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::get('admin',[AdminLoginController::class,'AdminDetails']);
    Route::get('logout',[AdminLoginController::class,'logout']);

    /////Settings
    Route::group(['prefix' => 'settings'],function(){

        ////About
        Route::group(['prefix' => 'about'],function(){
            Route::get('edit',[AboutController::class,'edit']);
            Route::post('update',[AboutController::class,'update']);
        });



    });
});
 */

 
use App\Http\Controllers\Api\User\UserLoginController;
use Illuminate\Support\Facades\Route;

Route::post('login',[UserLoginController::class,'login']);

Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::get('profile',[UserLoginController::class,'UserDetails']);
    Route::get('logout',[UserLoginController::class,'logout']);
});
