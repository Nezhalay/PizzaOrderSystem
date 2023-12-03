<?php

use App\Models\product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\user\AjaxController;
use App\Http\Controllers\User\UserController;

// login & register
Route::middleware(['admin_auth'])->group(function(){

    Route::redirect('/', 'loginPage',);
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');

});

//Middleware
Route::middleware(['auth'])->group(function () {

    //dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

//Admin...............
    Route::middleware(['admin_auth'])->group(function () {
        //category
        Route::prefix('category')->group(function () {
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete') ;
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
            Route::post('update/{id}',[CategoryController::class,'update'])->name('catgory#update');
        });

        //AdminAccount (changePassword)
        Route::prefix('admin')->group(function () {
            //password
            Route::get('password/changePage',[AdminController::class,'changePage'])->name('admin#changePage');
            Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changePassword');

            //profile
            Route::get('details',[AdminController::class,'details'])->name('admin#details');
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
            Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');

            // admin list
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
            Route::post('change/role/{id}',[AdminController::class,'change'])->name('admin#change');
        });

        //product pizza
        Route::prefix('product')->group(function (){
            // list
            Route::get('list',[ProductController::class,'list'])->name('product#list');
            Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('create',[ProductController::class,'create'])->name('product#create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
            Route::get('update/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
            Route::post('update',[ProductController::class,'update'])->name('product#update');
        });
    });

//User................
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
        // home
        Route::get('/home',[UserController::class,'home'])->name('user#home');
        Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');

        // details
        Route::prefix('pizza')->group(function(){
            Route::get('details/{id}',[UserController::class,'pizzaDetails'])->name('user#pizzaDetails');
        });

        // user
        Route::prefix('user')->group(function(){
            Route::get('change',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('changePassword',[UserController::class,'changePassword'])->name('user#changePassword');
        });
        // account
        Route::prefix('account')->group(function(){
            Route::get('change',[UserController::class,'changeAccountPage'])->name('user#changeAccountPage');
            Route::post('change/{id}',[UserController::class,'changeAccount'])->name('user#changeAccount');
        });
        // Jquery
        Route::prefix('ajax')->group(function(){
            Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCard',[AjaxController::class,'addToCard'])->name('ajax#addToCard');
        });

    });
});











//<---------Another Methods--------->

//Middleware

// Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])->group(function () {  //[Auth::login(),Auth::logout() လုပ်တဲ့အခါ error အနဲငယ်ရှိတက်သောကြောင့် ]

    //Admin...............
    // Route::group(['middleware'=>'admin_auth'],function () {   });   //<--အားသာချက်က prefix/middleware/namespace တို့စုရေးလို့ရ -->
    // Route::group(['prefix'=>'category','middleware'=>'admin_auth'],function(){  });  //<--အားသာချက်က prefix/middleware/namespace တို့စုရေးလို့ရ -->

// }

