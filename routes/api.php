<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\UserLoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ProfilController;

use App\Http\Controllers\Api\ProductController;

use App\Http\Controllers\Api\ContactController;

Route::post('user/register',[RegisterController::class,'UserRegister'])->name('user.register');
Route::post('vendeur/register',[RegisterController::class,'VendeurRegister'])->name('vendeur.register');
Route::post('creche/register',[RegisterController::class,'CrecheRegister'])->name('creche.register');

Route::post('login',[UserLoginController::class,'login']);



Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::get('profile',[ProfilController::class,'Profile']);
    Route::post('changePassword',[ProfilController::class,'ChangePassword']);
    Route::post('changeInformation',[ProfilController::class,'ChangeInformation']);
    Route::post('changeInformationVendor',[ProfilController::class,'ChangeInformationVendor']);
    Route::post('changeInformationCreche',[ProfilController::class,'ChangeInformationCreche']);
    Route::get('logout',[UserLoginController::class,'logout']);

    
    //blogs route api
    Route::group(['prefix' => 'blogs'],function(){
        Route::get('/',[ContactController::class,'getAllBlogs'])->name('blogs');
        Route::post('/add_blog',[ContactController::class,'addBlogs'])->name('blogs.add');
    });

    //products route api
    Route::group(['prefix' => 'products'],function(){
        Route::get('/',[ProductController::class,'GetAllProducts'])->name('products');
        Route::post('/add-product',[ProductController::class,'AddProduct'])->name('products.add');
        Route::post('/update-product/{uuid}',[ProductController::class,'UpdateProduct'])->name('products.update');
        Route::post('/show-product/{uuid}',[ProductController::class,'ShowProduct'])->name('products.show');
    });
});

Route::group(['prefix' => 'contact'],function(){
    Route::post('store',[ContactController::class,'store'])->name('contact.store');
});

