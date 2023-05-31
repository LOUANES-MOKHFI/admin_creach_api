<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\UserLoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ProfilController;

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;


use App\Http\Controllers\Api\OffreController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CommentController;

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

    //offres emplois route api
    Route::group(['prefix' => 'offres_emplois'],function(){
        Route::get('/',[OffreController::class,'GetAllOffres'])->name('offres_emplois');
        Route::post('/add-offre',[OffreController::class,'AddOffre'])->name('offres_emplois.add');
        Route::post('/update-offre/{uuid}',[OffreController::class,'UpdateOffre'])->name('offres_emplois.update');
        Route::get('/show-offre/{uuid}',[OffreController::class,'ShowOffre'])->name('offres_emplois.show');
        Route::get('/stop-offre/{uuid}',[OffreController::class,'StopOffre'])->name('offres_emplois.stop_offre');
        Route::get('/show-all-offres',[OffreController::class,'ShowAllOffres'])->name('offres_emplois.show_all_offres');
        
    });

    //products route api
    Route::group(['prefix' => 'products'],function(){
        Route::get('/',[ProductController::class,'GetAllProducts'])->name('products');
        Route::post('/add-product',[ProductController::class,'AddProduct'])->name('products.add');
        Route::post('/update-product/{uuid}',[ProductController::class,'UpdateProduct'])->name('products.update');
        Route::get('/show-product/{uuid}',[ProductController::class,'ShowProduct'])->name('products.show');
    });
    //blogs route api
    Route::group(['prefix' => 'blogs'],function(){
        Route::get('/',[BlogController::class,'GetAllBlogs'])->name('blogs');
        Route::post('/add-blog',[BlogController::class,'AddBlog'])->name('blogs.add');
        Route::post('/update-blog/{uuid}',[BlogController::class,'UpdateBlog'])->name('blogs.update');
        Route::get('/show-blog/{uuid}',[BlogController::class,'ShowBlog'])->name('blogs.show');
        Route::post('/add-heart',[BlogController::class,'AddHeartToBlog'])->name('blogs.addHeart');
        
    });

    //Comment route api
    Route::group(['prefix' => 'comments'],function(){
        Route::get('/',[CommentController::class,'GetAllComments'])->name('comments');
        Route::post('/add-comment',[CommentController::class,'AddComment'])->name('comments.add');
        Route::post('/update-comment/{uuid}',[CommentController::class,'UpdateComment'])->name('comments.update');
    });

    //Orders Product route api
    Route::group(['prefix' => 'orders'],function(){
        Route::get('/',[OrderController::class,'GetAllMyOrders'])->name('orders');
        Route::post('/add-order',[OrderController::class,'AddOrder'])->name('orders.add');
        //Route::post('/update-comment/{uuid}',[OrderController::class,'UpdateOrder'])->name('orders.update');
    });

    //my_orders Product route api
    Route::group(['prefix' => 'my_orders'],function(){
        Route::get('/',[OrderController::class,'GetAllMyStoreOrders'])->name('my_orders');
        Route::get('/show/{id}',[OrderController::class,'ShowStoreOrders'])->name('my_orders.show');
    });

});

Route::group(['prefix' => 'contact'],function(){
    Route::post('store',[ContactController::class,'store'])->name('contact.store');
});

Route::group(['prefix' => 'offres_emplois'],function(){
    Route::get('/show-all-offres',[OffreController::class,'ShowAllOffres'])->name('offres_emplois.show_all_offres');
    
});

