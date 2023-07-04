<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/404', '404');

Route::get('/player', function () {
    return view('layouts.player');
});





// Route::get('/admin/songs','SongController@show' );


Route::group(['namespace' => 'App\Http\Controllers'], function () {
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function () {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
    });

    Route::group(['middleware' => ['auth']], function () {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
        // Route::get('/admin', function () {
        //     return view('admins/dashboard');
        // });
        // Route::get('/admin/songs', 'SongController@index');
        // Route::post('/songs/save-song', 'SongController@store');

        // Route::get('/category', 'CategoryController@index');
        // // Route::post('/admin/category-store',[CategoryController::class, 'store']);
        // Route::post('/category-store', 'CategoryController@store');


        // Product
        // Route::get('/admin', [ProductController::class, 'index'])->name('products.index')->middleware('checklogin::class');
        // 
        Route::get('/product/index', [ProductController::class, 'index'])->name('products.index')->middleware('checklogin::class');
        Route::get('/product/create', [ProductController::class, 'create'])->name('products.create')->middleware('checklogin::class');;
        Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('checklogin::class');;
        Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('products.edit')->middleware('checklogin::class');;
        Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::get('/product/show/{id}', [ProductController::class, 'show'])->name('products.show')->middleware('checklogin::class');;
        Route::post('/product/store', [ProductController::class, 'store'])->name('products.store');

        //Category
        Route::get('/category/index', [CategoryController::class, 'index'])->name('category.index')->middleware('checklogin::class');;
        Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create')->middleware('checklogin::class');;
        Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy')->middleware('checklogin::class');;
        Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit')->middleware('checklogin::class');;
        Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/category/show/{id}', [CategoryController::class, 'show'])->name('category.show')->middleware('checklogin::class');;
        Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    });
});
