<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SongAlbumController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\TrackController;



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
    Route::get('/search', 'SearchController@index')->name('search.index');
    Route::get('/genre/{name}', 'PopController@show')->name('genre.show');

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

        Route::get('/admin', 'DashboardController@index')->middleware('checklogin');

        Route::get('/user', [UserController::class, 'index'])->middleware('checklogin::class');
        Route::get('/user-edit/{id}', 'UserController@edit')->middleware('checklogin::class');
        Route::put('/user-update/{id}', 'UserController@update')->name('user.update')->middleware('checklogin');
        Route::delete('/user-delete/{id}', 'UserController@delete')->name('user.delete')->middleware('checklogin');

        Route::post('/artist', 'ArtistController@store')->name('artist.store')->middleware('checklogin');
        Route::get('/artist', 'ArtistController@index')->name('artist.index')->middleware('checklogin');
        Route::get('/artist-edit/{id}', 'ArtistController@edit')->name('artist.edit')->middleware('checklogin');
        Route::put('/artist-update/{id}', 'ArtistController@update')->name('artist.update')->middleware('checklogin');
        Route::delete('/artist-delete/{id}', 'ArtistController@delete')->name('artist.delete')->middleware('checklogin');

        Route::post('/genre', 'GenreController@store')->name('genre.store')->middleware('checklogin');
        Route::get('/genre', 'GenreController@index')->name('genre.index')->middleware('checklogin');
        Route::get('/genre-edit/{id}', 'GenreController@edit')->name('genre.edit')->middleware('checklogin');
        Route::put('/genre-update/{id}', 'GenreController@update')->name('genre.update')->middleware('checklogin');
        Route::delete('/genre-delete/{id}', 'GenreController@delete')->name('genre.delete')->middleware('checklogin');

        Route::post('/song', 'SongController@store')->name('song.store')->middleware('checklogin');
        Route::get('/song', 'SongController@index')->name('song.index')->middleware('checklogin');
        Route::get('/song-edit/{id}', 'SongController@edit')->name('song.edit')->middleware('checklogin');
        Route::put('/song-update/{id}', 'SongController@update')->name('song.update')->middleware('checklogin');
        Route::delete('/song-delete/{id}', 'SongController@delete')->name('song.delete')->middleware('checklogin');


        Route::post('/album', 'AlbumController@store')->name('album.store')->middleware('checklogin');
        Route::get('/album', 'AlbumController@index')->name('album.index')->middleware('checklogin');
        Route::get('/album-edit/{id}', 'AlbumController@edit')->name('album.edit')->middleware('checklogin');
        Route::put('/album-update/{id}', 'AlbumController@update')->name('album.update')->middleware('checklogin');
        Route::delete('/album-delete/{id}', 'AlbumController@delete')->name('album.delete')->middleware('checklogin');


        Route::post('/song-album', 'SongAlbumController@store')->name('song-album.store')->middleware('checklogin');
        Route::get('/song-album', 'SongAlbumController@index')->name('song-album.index')->middleware('checklogin');
        Route::get('/song-album-edit/{id}', 'SongAlbumController@edit')->name('song-album.edit')->middleware('checklogin');
        // Route::put('/song-album-update/{albumSong}', 'SongAlbumController@update')->name('song-album.update')->middleware('checklogin');
        Route::delete('/song-album-delete/{albumId}/{songId}', 'SongAlbumController@delete')->name('song-album.delete')->middleware('checklogin');
        // Route::get('/admin', [ProductController::class, 'index'])->name('products.index')->middleware('checklogin::class');
        // 

        Route::post('/artist-album', 'AlbumArtistController@store')->name('artist-album.store')->middleware('checklogin');
        Route::get('/artist-album', 'AlbumArtistController@index')->name('artist-album.index')->middleware('checklogin');
        Route::get('/artist-album-edit/{id}', 'AlbumArtistController@edit')->name('artist-album.edit')->middleware('checklogin');
        Route::delete('/artist-album-delete/{albumId}/{artistId}', 'AlbumArtistController@delete')->name('artist-album.delete')->middleware('checklogin');

        Route::post('/artist-song', 'SongArtistController@store')->name('artist-song.store')->middleware('checklogin');
        Route::get('/artist-song', 'SongArtistController@index')->name('artist-song.index')->middleware('checklogin');
        Route::get('/artist-song-edit/{id}', 'SongArtistController@edit')->name('artist-song.edit')->middleware('checklogin');
        Route::delete('/artist-song-delete/{songId}/{artistId}', 'SongArtistController@delete')->name('artist-song.delete')->middleware('checklogin');

        Route::post('/track', 'TrackController@store')->name('track.store')->middleware('checklogin');
        Route::get('/track', 'TrackController@index')->name('track.index')->middleware('checklogin');
        Route::get('/track-edit/{id}', 'TrackController@edit')->name('track.edit')->middleware('checklogin');
        Route::put('/track-update/{id}', 'TrackController@update')->name('track.update')->middleware('checklogin');
        Route::delete('/track-delete/{id}', 'TrackController@delete')->name('track.delete')->middleware('checklogin');


        Route::post('/toggle-like/{songId}', 'LikesController@toggleLike')->middleware('web');

        // Route::get('/product/index', [ProductController::class, 'index'])->name('products.index')->middleware('checklogin::class');
        // Route::get('/product/create', [ProductController::class, 'create'])->name('products.create')->middleware('checklogin::class');;
        // Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('checklogin::class');;
        // Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('products.edit')->middleware('checklogin::class');;
        // Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('products.update');
        // Route::get('/product/show/{id}', [ProductController::class, 'show'])->name('products.show')->middleware('checklogin::class');;
        // Route::post('/product/store', [ProductController::class, 'store'])->name('products.store');

        // //Category
        // Route::get('/category/index', [CategoryController::class, 'index'])->name('category.index')->middleware('checklogin::class');;
        // Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create')->middleware('checklogin::class');;
        // Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy')->middleware('checklogin::class');;
        // Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit')->middleware('checklogin::class');;
        // Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        // Route::get('/category/show/{id}', [CategoryController::class, 'show'])->name('category.show')->middleware('checklogin::class');;
        // Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    });
});
