<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\DomaineVendeurController;
use App\Http\Controllers\Admin\CategoriesProductsController;
use App\Http\Controllers\Admin\CategoriesBlogsController;


Route::get('/',[AdminController::class,'login'])->name('admin.login');
Route::post('/login',[AdminController::class,'Postlogin'])->name('admin.Postlogin');

Route::group(['prefix' => 'admin','middleware'=>'auth:admins'],function(){
    /// index page
    Route::get('/index',[HomeController::class,'index'])->name('admin');
    Route::get('/settings',[HomeController::class,'settings'])->name('admin.settings');

    //Logout
    Route::get('/logout',[AdminController::class,'logout'])->name('admin.logout');
    ///Admin routes
    Route::group(['prefix' => 'users'],function(){
        Route::get('/',[UserController::class,'index'])->name('admin.users');
        Route::get('create',[UserController::class,'create'])->name('admin.users.create');
        Route::post('store',[UserController::class,'store'])->name('admin.users.store');
        Route::get('edit/{id}',[UserController::class,'edit'])->name('admin.users.edit');
        Route::post('update/{id}',[UserController::class,'update'])->name('admin.users.update');
        Route::get('delete/{id}',[UserController::class,'destroy'])->name('admin.users.delete');
        Route::get('changeStatus/{uuid}',[UserController::class,'changeStatus'])->name('admin.users.changeStatus');
       // Route::get('changeStatusExit/{uuid}',[UserController::class,'changeStatusExit'])->name('admin.users.changeStatusExit');
    });

    ////Settings Routes
    Route::group(['prefix' => 'settings'],function(){
        Route::get('/',[HomeController::class,'settings'])->name('admin.settings');
        
        ////About
        Route::group(['prefix' => 'about'],function(){
            Route::get('edit',[AboutController::class,'edit'])->name('admin.settings.about');
            Route::post('update',[AboutController::class,'update'])->name('admin.settings.about.update');
        });
        
        ///Domaines des vendeurs
        Route::group(['prefix' => 'domaines'],function(){
            Route::get('/',[DomaineVendeurController::class,'index'])->name('admin.settings.domaines');
            Route::get('create',[DomaineVendeurController::class,'create'])->name('admin.settings.domaines.create');
            Route::post('store',[DomaineVendeurController::class,'store'])->name('admin.settings.domaines.store');
            Route::get('edit/{id}',[DomaineVendeurController::class,'edit'])->name('admin.settings.domaines.edit');
            Route::post('update/{id}',[DomaineVendeurController::class,'update'])->name('admin.settings.domaines.update');
            Route::get('delete/{id}',[DomaineVendeurController::class,'destroy'])->name('admin.settings.domaines.delete');
            Route::get('changeStatus/{uuid}',[DomaineVendeurController::class,'changeStatus'])->name('admin.settings.domaines.changeStatus');
        });
        ///categorie products
        Route::group(['prefix' => 'categories_products'],function(){
            Route::get('/',[CategoriesProductsController::class,'index'])->name('admin.settings.categories_products');
            Route::get('create',[CategoriesProductsController::class,'create'])->name('admin.settings.categories_products.create');
            Route::post('store',[CategoriesProductsController::class,'store'])->name('admin.settings.categories_products.store');
            Route::get('edit/{id}',[CategoriesProductsController::class,'edit'])->name('admin.settings.categories_products.edit');
            Route::post('update/{id}',[CategoriesProductsController::class,'update'])->name('admin.settings.categories_products.update');
            Route::get('delete/{id}',[CategoriesProductsController::class,'destroy'])->name('admin.settings.categories_products.delete');
            Route::get('changeStatus/{uuid}',[CategoriesProductsController::class,'changeStatus'])->name('admin.settings.categories_products.changeStatus');
        });
        ///categorie blogs
        Route::group(['prefix' => 'categories_blogs'],function(){
            Route::get('/',[CategoriesBlogsController::class,'index'])->name('admin.settings.categories_blogs');
            Route::get('create',[CategoriesBlogsController::class,'create'])->name('admin.settings.categories_blogs.create');
            Route::post('store',[CategoriesBlogsController::class,'store'])->name('admin.settings.categories_blogs.store');
            Route::get('edit/{id}',[CategoriesBlogsController::class,'edit'])->name('admin.settings.categories_blogs.edit');
            Route::post('update/{id}',[CategoriesBlogsController::class,'update'])->name('admin.settings.categories_blogs.update');
            Route::get('delete/{id}',[CategoriesBlogsController::class,'destroy'])->name('admin.settings.categories_blogs.delete');
            Route::get('changeStatus/{uuid}',[CategoriesBlogsController::class,'changeStatus'])->name('admin.settings.categories_blogs.changeStatus');
        });

        



    });
});

