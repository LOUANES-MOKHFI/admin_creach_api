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
use App\Http\Controllers\Api\DemandeEmploiController;

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\CrecheController;
use App\Http\Controllers\Api\VendorController;
use App\Http\Controllers\Api\ProgrammeCrecheController;

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
        
    });
    //Demande emplois route api
    Route::group(['prefix' => 'demandes_emplois'],function(){
        Route::get('/show-all-demandes',[DemandeEmploiController::class,'GetAllDemandesEmploi'])->name('demandes_emplois');
        Route::get('/show-demande-emploi/{uuid}',[DemandeEmploiController::class,'ShowDemandeEmploi'])->name('demandes_emplois.show');        
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


    // postuler User Route
    Route::group(['prefix' => 'demande_emplois'],function(){
        Route::post('/postuler',[DemandeEmploiController::class,'Postuler'])->name('demande_emplois.postuler');
        
    });

});

Route::group(['prefix' => 'contact'],function(){
    Route::post('store',[ContactController::class,'store'])->name('contact.store');
});

Route::group(['prefix' => 'about'],function(){
    Route::get('/',[AboutController::class,'About'])->name('about');
});

Route::group(['prefix' => 'services'],function(){
    Route::get('/',[ServiceController::class,'GetAllServices'])->name('services');
    Route::get('/show-service/{slug}',[ServiceController::class,'ShowService'])->name('services.show');
});

Route::group(['prefix' => 'creches'],function(){
    Route::get('/',[CrecheController::class,'GetAllCreches'])->name('creches');
    Route::get('/show-creche/{uuid}',[CrecheController::class,'ShowCreche'])->name('creches.show');
    Route::get('/search-creche/{keyword}',[CrecheController::class,'SearchCreche'])->name('creches.search');
    Route::get('/blogs',[CrecheController::class,'GetAllBlogs'])->name('creches.blogs');
    Route::get('/blogs/show/{slug}',[CrecheController::class,'ShowBlog'])->name('creches.blogs.show');
});

Route::group(['prefix' => 'offres_emplois'],function(){
    Route::get('/show-all-offres',[OffreController::class,'ShowAllOffres'])->name('offres_emplois.show_all_offres');
    Route::get('/show_offre/{uuid}',[OffreController::class,'ShowOffreToUser'])->name('offres_emplois.show_offre');    
});

Route::group(['prefix' => 'vendors'],function(){
    Route::get('/',[VendorController::class,'GetAllVendors'])->name('vendors');
    Route::get('/show-vendor/{uuid}',[VendorController::class,'ShowVendor'])->name('vendors.show');
    Route::get('/search-vendor/{keyword}',[VendorController::class,'SearchVendor'])->name('vendors.search');
    Route::get('/products',[VendorController::class,'GetAllProducts'])->name('vendors.products');
    Route::get('/products/show/{slug}',[VendorController::class,'ShowProduct'])->name('vendors.products.show');
});

Route::group(['prefix' => 'programme_creche'],function(){
    Route::get('/guide-pedagogique',[ProgrammeCrecheController::class,'ShowGuidePedagogique'])->name('programme_creche.guide_pedagogique');
    Route::get('/show-programme',[ProgrammeCrecheController::class,'ShowProgramme'])->name('programme_creche.show_programme');    
});




