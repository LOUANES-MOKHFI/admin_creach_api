<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\DomaineVendeurController;
use App\Http\Controllers\Admin\CategoriesProductsController;
use App\Http\Controllers\Admin\CategoriesBlogsController;
use App\Http\Controllers\Admin\RealisationController;
use App\Http\Controllers\Admin\ProgrammeCrecheController;
use App\Http\Controllers\Admin\TypesUsersController;
use App\Http\Controllers\Admin\EmpoloiController;
use App\Http\Controllers\Admin\DomaineConseilController;
use App\Http\Controllers\Admin\GuidePedagogiqueController;
use App\Http\Controllers\Admin\NiveauBooksController;
use App\Http\Controllers\Admin\BookCrecheController;
use App\Http\Controllers\Admin\CategoryFaqController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\CrecheController;
use App\Http\Controllers\Admin\VendeurController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContributionBlogController;
use App\Http\Controllers\Admin\PubliciteController;
use App\Http\Controllers\Admin\OffreEmploiController;


Route::get('/',[AdminController::class,'login'])->name('admin.login');
Route::post('/login',[AdminController::class,'Postlogin'])->name('admin.Postlogin');

Route::group(['prefix' => 'admin','middleware'=>'auth:admins'],function(){
    /// index page
    Route::get('/index',[HomeController::class,'index'])->name('admin');
    Route::get('/settings',[HomeController::class,'settings'])->name('admin.settings');

    //Logout
    Route::get('/logout',[AdminController::class,'logout'])->name('admin.logout');
    //Roles routes
    //Route::resource('roles', RoleController::class);
    Route::group(['prefix' => 'roles','middleware' => 'can:role-list'],function(){
        Route::get('/',[RoleController::class,'index'])->name('admin.roles');
        Route::get('create',[RoleController::class,'create'])->name('admin.roles.create');
        Route::post('store',[RoleController::class,'store'])->name('admin.roles.store');
        Route::get('edit/{id}',[RoleController::class,'edit'])->name('admin.roles.edit');
        Route::post('update/{id}',[RoleController::class,'update'])->name('admin.roles.update');
        Route::get('show/{id}',[RoleController::class,'show'])->name('admin.roles.show');
        Route::get('destroy/{id}',[RoleController::class,'destroy'])->name('admin.roles.destroy');
    }); 
    ///Admin routes
     Route::group(['prefix' => 'admins','middleware' => 'can:role-list'],function(){
        Route::get('/',[AdminController::class,'index'])->name('admin.admins');
        Route::get('create',[AdminController::class,'create'])->name('admin.admins.create');
        Route::post('store',[AdminController::class,'store'])->name('admin.admins.store');
        Route::get('edit/{id}',[AdminController::class,'edit'])->name('admin.admins.edit');
        Route::post('update/{id}',[AdminController::class,'update'])->name('admin.admins.update');
        Route::get('delete/{id}',[AdminController::class,'destroy'])->name('admin.admins.delete');
    }); 

    ////Settings Routes
    Route::group(['prefix' => 'settings','middleware' => 'can:setting-list'],function(){
        Route::get('/',[HomeController::class,'settings'])->name('admin.settings');
        
        ////About
        Route::group(['prefix' => 'about'],function(){
            Route::get('edit',[AboutController::class,'edit'])->name('admin.settings.about');
            Route::post('update',[AboutController::class,'update'])->name('admin.settings.about.update');
            Route::post('updateGerant',[AboutController::class,'updateGerant'])->name('admin.settings.about.updateGerant');  
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
        ///Nos réalisations
        Route::group(['prefix' => 'realisations'],function(){
            Route::get('/',[RealisationController::class,'index'])->name('admin.settings.realisations');
            Route::get('create',[RealisationController::class,'create'])->name('admin.settings.realisations.create');
            Route::post('store',[RealisationController::class,'store'])->name('admin.settings.realisations.store');
            Route::get('edit/{id}',[RealisationController::class,'edit'])->name('admin.settings.realisations.edit');
            Route::post('update/{id}',[RealisationController::class,'update'])->name('admin.settings.realisations.update');
            Route::get('delete/{id}',[RealisationController::class,'destroy'])->name('admin.settings.realisations.delete');
            Route::get('changeStatus/{uuid}',[RealisationController::class,'changeStatus'])->name('admin.settings.realisations.changeStatus');
            Route::get('deleteImage/{uuid}',[RealisationController::class,'deleteImage'])->name('admin.settings.realisations.deleteImage');
        });
        ///programmes creches
        Route::group(['prefix' => 'programmes'],function(){
            Route::get('/',[ProgrammeCrecheController::class,'index'])->name('admin.settings.programmes');
            Route::get('create',[ProgrammeCrecheController::class,'create'])->name('admin.settings.programmes.create');
            Route::post('store',[ProgrammeCrecheController::class,'store'])->name('admin.settings.programmes.store');
            Route::get('edit/{id}',[ProgrammeCrecheController::class,'edit'])->name('admin.settings.programmes.edit');
            Route::post('update/{id}',[ProgrammeCrecheController::class,'update'])->name('admin.settings.programmes.update');
            Route::get('delete/{id}',[ProgrammeCrecheController::class,'destroy'])->name('admin.settings.programmes.delete');
            Route::get('changeStatus/{uuid}',[ProgrammeCrecheController::class,'changeStatus'])->name('admin.settings.programmes.changeStatus');
        });
        ///type_users
        Route::group(['prefix' => 'types_users'],function(){
            Route::get('/',[TypesUsersController::class,'index'])->name('admin.settings.types_users');
            Route::get('create',[TypesUsersController::class,'create'])->name('admin.settings.types_users.create');
            Route::post('store',[TypesUsersController::class,'store'])->name('admin.settings.types_users.store');
            Route::get('edit/{id}',[TypesUsersController::class,'edit'])->name('admin.settings.types_users.edit');
            Route::post('update/{id}',[TypesUsersController::class,'update'])->name('admin.settings.types_users.update');
            Route::get('delete/{id}',[TypesUsersController::class,'destroy'])->name('admin.settings.types_users.delete');
            Route::get('changeStatus/{uuid}',[TypesUsersController::class,'changeStatus'])->name('admin.settings.types_users.changeStatus');
        });
        ///emplois
        Route::group(['prefix' => 'emplois'],function(){
            Route::get('/',[EmpoloiController::class,'index'])->name('admin.settings.emplois');
            Route::get('create',[EmpoloiController::class,'create'])->name('admin.settings.emplois.create');
            Route::post('store',[EmpoloiController::class,'store'])->name('admin.settings.emplois.store');
            Route::get('edit/{id}',[EmpoloiController::class,'edit'])->name('admin.settings.emplois.edit');
            Route::post('update/{id}',[EmpoloiController::class,'update'])->name('admin.settings.emplois.update');
            Route::get('delete/{id}',[EmpoloiController::class,'destroy'])->name('admin.settings.emplois.delete');
            Route::get('changeStatus/{uuid}',[EmpoloiController::class,'changeStatus'])->name('admin.settings.emplois.changeStatus');
        });
        ///domaines_conseils
        Route::group(['prefix' => 'domaines_conseils'],function(){
            Route::get('/',[DomaineConseilController::class,'index'])->name('admin.settings.domaines_conseils');
            Route::get('create',[DomaineConseilController::class,'create'])->name('admin.settings.domaines_conseils.create');
            Route::post('store',[DomaineConseilController::class,'store'])->name('admin.settings.domaines_conseils.store');
            Route::get('edit/{id}',[DomaineConseilController::class,'edit'])->name('admin.settings.domaines_conseils.edit');
            Route::post('update/{id}',[DomaineConseilController::class,'update'])->name('admin.settings.domaines_conseils.update');
            Route::get('delete/{id}',[DomaineConseilController::class,'destroy'])->name('admin.settings.domaines_conseils.delete');
            Route::get('changeStatus/{uuid}',[DomaineConseilController::class,'changeStatus'])->name('admin.settings.domaines_conseils.changeStatus');
        });

        ///publicite
        Route::group(['prefix' => 'publicite'],function(){
            Route::get('/',[PubliciteController::class,'index'])->name('admin.settings.publicites');
            Route::get('create',[PubliciteController::class,'create'])->name('admin.settings.publicites.create');
            Route::post('store',[PubliciteController::class,'store'])->name('admin.settings.publicites.store');
            Route::get('edit/{id}',[PubliciteController::class,'edit'])->name('admin.settings.publicites.edit');
            Route::post('update/{id}',[PubliciteController::class,'update'])->name('admin.settings.publicites.update');
            Route::get('delete/{id}',[PubliciteController::class,'destroy'])->name('admin.settings.publicites.delete');
            Route::get('changeStatus/{uuid}',[PubliciteController::class,'changeStatus'])->name('admin.settings.publicites.changeStatus');
        });
    });


    
    ///guide_pedagogique
    Route::group(['prefix' => 'guide_pedagogique'],function(){
        Route::get('/',[GuidePedagogiqueController::class,'index'])->name('admin.guide_pedagogique');
        Route::get('create',[GuidePedagogiqueController::class,'create'])->name('admin.guide_pedagogique.create');
        Route::post('store',[GuidePedagogiqueController::class,'store'])->name('admin.guide_pedagogique.store');
        Route::get('edit/{id}',[GuidePedagogiqueController::class,'edit'])->name('admin.guide_pedagogique.edit');
        Route::post('update/{id}',[GuidePedagogiqueController::class,'update'])->name('admin.guide_pedagogique.update');
        Route::get('delete/{id}',[GuidePedagogiqueController::class,'destroy'])->name('admin.guide_pedagogique.delete');
        Route::get('changeStatus/{uuid}',[GuidePedagogiqueController::class,'changeStatus'])->name('admin.guide_pedagogique.changeStatus');
        Route::get('deleteImage/{uuid}',[GuidePedagogiqueController::class,'deleteImage'])->name('admin.guide_pedagogique.deleteImage');
    
    });
    ///niveaux books
    Route::group(['prefix' => 'niveau_books'],function(){
        Route::get('/',[NiveauBooksController::class,'index'])->name('admin.niveau_books');
        Route::get('create',[NiveauBooksController::class,'create'])->name('admin.niveau_books.create');
        Route::post('store',[NiveauBooksController::class,'store'])->name('admin.niveau_books.store');
        Route::get('edit/{id}',[NiveauBooksController::class,'edit'])->name('admin.niveau_books.edit');
        Route::post('update/{id}',[NiveauBooksController::class,'update'])->name('admin.niveau_books.update');
        Route::get('delete/{id}',[NiveauBooksController::class,'destroy'])->name('admin.niveau_books.delete');
        Route::get('changeStatus/{uuid}',[NiveauBooksController::class,'changeStatus'])->name('admin.niveau_books.changeStatus');
    });
    ///books_creche
    Route::group(['prefix' => 'books_creche'],function(){
        Route::get('/',[BookCrecheController::class,'index'])->name('admin.books_creche');
        Route::get('create',[BookCrecheController::class,'create'])->name('admin.books_creche.create');
        Route::post('store',[BookCrecheController::class,'store'])->name('admin.books_creche.store');
        Route::get('edit/{id}',[BookCrecheController::class,'edit'])->name('admin.books_creche.edit');
        Route::post('update/{id}',[BookCrecheController::class,'update'])->name('admin.books_creche.update');
        Route::get('delete/{id}',[BookCrecheController::class,'destroy'])->name('admin.books_creche.delete');
        Route::get('changeStatus/{uuid}',[BookCrecheController::class,'changeStatus'])->name('admin.books_creche.changeStatus');
    });

    ///category_faq
    Route::group(['prefix' => 'categories_faqs'],function(){
        Route::get('/',[CategoryFaqController::class,'index'])->name('admin.categories_faqs');
        Route::get('create',[CategoryFaqController::class,'create'])->name('admin.categories_faqs.create');
        Route::post('store',[CategoryFaqController::class,'store'])->name('admin.categories_faqs.store');
        Route::get('edit/{id}',[CategoryFaqController::class,'edit'])->name('admin.categories_faqs.edit');
        Route::post('update/{id}',[CategoryFaqController::class,'update'])->name('admin.categories_faqs.update');
        Route::get('delete/{id}',[CategoryFaqController::class,'destroy'])->name('admin.categories_faqs.delete');
        Route::get('changeStatus/{uuid}',[CategoryFaqController::class,'changeStatus'])->name('admin.categories_faqs.changeStatus');
    });
    ///faq
    Route::group(['prefix' => 'faqs'],function(){
        Route::get('/',[FaqController::class,'index'])->name('admin.faqs');
        Route::get('create',[FaqController::class,'create'])->name('admin.faqs.create');
        Route::post('store',[FaqController::class,'store'])->name('admin.faqs.store');
        Route::get('show/{uuid}',[FaqController::class,'show'])->name('admin.faqs.show');
        Route::get('edit/{uuid}',[FaqController::class,'edit'])->name('admin.faqs.edit');
        Route::post('update/{uuid}',[FaqController::class,'update'])->name('admin.faqs.update');
        Route::get('delete/{uuid}',[FaqController::class,'destroy'])->name('admin.faqs.delete');
        Route::get('changeStatus/{uuid}',[FaqController::class,'changeStatus'])->name('admin.faqs.changeStatus');
    });
    ///videos
    Route::group(['prefix' => 'videos'],function(){
        Route::get('/',[VideoController::class,'index'])->name('admin.videos');
        Route::get('create',[VideoController::class,'create'])->name('admin.videos.create');
        Route::post('store',[VideoController::class,'store'])->name('admin.videos.store');
        Route::get('show/{uuid}',[VideoController::class,'show'])->name('admin.videos.show');
        Route::get('edit/{uuid}',[VideoController::class,'edit'])->name('admin.videos.edit');
        Route::post('update/{uuid}',[VideoController::class,'update'])->name('admin.videos.update');
        Route::get('delete/{uuid}',[VideoController::class,'destroy'])->name('admin.videos.delete');
        Route::get('changeStatus/{uuid}',[VideoController::class,'changeStatus'])->name('admin.videos.changeStatus');
    });
    ///contacts
    Route::group(['prefix' => 'contacts'],function(){
        Route::get('/',[ContactController::class,'index'])->name('admin.contacts');
        Route::get('show/{uuid}',[ContactController::class,'show'])->name('admin.contacts.show');
        Route::get('delete/{uuid}',[ContactController::class,'destroy'])->name('admin.contacts.delete');
    });

    ///Users routes
    Route::group(['prefix' => 'users','middleware' => 'can:user-list'],function(){
        Route::get('/',[UserController::class,'index'])->name('admin.users');
        Route::post('store',[UserController::class,'store'])->name('admin.users.store');
        Route::get('show/{id}',[UserController::class,'show'])->name('admin.users.show');
        Route::get('edit/{id}',[UserController::class,'edit'])->name('admin.users.edit');
        Route::post('update/{id}',[UserController::class,'update'])->name('admin.users.update');
        Route::get('delete/{id}',[UserController::class,'destroy'])->name('admin.users.delete');
        Route::get('changeStatus/{uuid}',[UserController::class,'changeStatus'])->name('admin.users.changeStatus');
        Route::get('confirmeAccount/{uuid}',[UserController::class,'confirmeAccount'])->name('admin.users.confirmeAccount');
        
    });
    ///vendeurs routes
    Route::group(['prefix' => 'vendeurs','middleware' => 'can:vendeur-list'],function(){
        Route::get('/',[VendeurController::class,'index'])->name('admin.vendeurs');
        Route::post('store',[VendeurController::class,'store'])->name('admin.vendeurs.store');
        Route::get('show/{id}',[VendeurController::class,'show'])->name('admin.vendeurs.show');
        Route::get('edit/{id}',[VendeurController::class,'edit'])->name('admin.vendeurs.edit');
        Route::post('update/{id}',[VendeurController::class,'update'])->name('admin.vendeurs.update');
        Route::get('delete/{id}',[VendeurController::class,'destroy'])->name('admin.vendeurs.delete');
        Route::get('changeStatus/{uuid}',[VendeurController::class,'changeStatus'])->name('admin.vendeurs.changeStatus');
        Route::get('confirmeAccount/{uuid}',[VendeurController::class,'confirmeAccount'])->name('admin.vendeurs.confirmeAccount');
        Route::get('{uuid}/products',[VendeurController::class,'ProductForVendor'])->name('admin.vendeurs.products');
    });
    ///creches routes
    Route::group(['prefix' => 'creches','middleware' => 'can:creche-list'],function(){
        Route::get('/',[CrecheController::class,'index'])->name('admin.creches');
        Route::post('store',[CrecheController::class,'store'])->name('admin.creches.store');
        Route::get('edit/{id}',[CrecheController::class,'edit'])->name('admin.creches.edit');
        Route::post('update/{id}',[CrecheController::class,'update'])->name('admin.creches.update');
        Route::get('show/{id}',[CrecheController::class,'show'])->name('admin.creches.show');
        Route::get('delete/{id}',[CrecheController::class,'destroy'])->name('admin.creches.delete');
        Route::get('changeStatus/{uuid}',[CrecheController::class,'changeStatus'])->name('admin.creches.changeStatus');
        Route::get('confirmeAccount/{uuid}',[CrecheController::class,'confirmeAccount'])->name('admin.creches.confirmeAccount');
    });
    ///notifications routes
    Route::group(['prefix' => 'notifications'],function(){
        Route::get('/',[NotificationController::class,'index'])->name('admin.notifications');
        Route::post('store',[NotificationController::class,'store'])->name('admin.notifications.store');
        Route::get('show/{id}',[NotificationController::class,'show'])->name('admin.notifications.show');
        Route::get('delete/{id}',[NotificationController::class,'destroy'])->name('admin.notifications.delete');
        Route::get('changeStatus/{uuid}',[NotificationController::class,'changeStatus'])->name('admin.notifications.changeStatus');
    });

    ///products routes
    Route::group(['prefix' => 'products','middleware' => 'can:product-list'],function(){
        Route::get('/',[ProductController::class,'index'])->name('admin.products');
        Route::get('show/{id}',[ProductController::class,'show'])->name('admin.products.show');
        Route::get('changeStatus/{uuid}',[ProductController::class,'changeStatus'])->name('admin.products.changeStatus');
    });

    ///blogs routes
    Route::group(['prefix' => 'blogs','middleware' => 'can:blog-list'],function(){
        Route::get('/',[BlogController::class,'index'])->name('admin.blogs');
        Route::get('show/{uuid}',[BlogController::class,'show'])->name('admin.blogs.show');
        Route::get('changeStatus/{uuid}',[BlogController::class,'changeStatus'])->name('admin.blogs.changeStatus');
        Route::get('deleteComment/{id}',[BlogController::class,'deleteComment'])->name('admin.blogs.deleteComment');

    });
    ///offre_emplois routes
    Route::group(['prefix' => 'offre_emplois','middleware' => 'can:offre-list'],function(){
        Route::get('/',[OffreEmploiController::class,'index'])->name('admin.offre_emplois');

    });

    ///contributions routes
    Route::group(['prefix' => 'contributions','middleware' => 'can:contribution-list'],function(){
        Route::get('/',[ContributionBlogController::class,'index'])->name('admin.contributions');
        Route::get('show/{uuid}',[ContributionBlogController::class,'show'])->name('admin.contributions.show');
        Route::get('changeStatus/{uuid}',[ContributionBlogController::class,'ChangeStatus'])->name('admin.contributions.changeStatus');
        Route::get('deleteComment/{id}',[ContributionBlogController::class,'deleteComment'])->name('admin.contributions.deleteComment');

    });


    
});

Route::get('get_communes_by_wilaya',[HomeController::class,'getCommunesByWilaya'])->name('admin.get_communes_by_wilaya');
