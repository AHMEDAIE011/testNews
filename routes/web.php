<?php

use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\NewSubController;
use App\Http\Controllers\Front\PostController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;

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

Route::redirect("/", '/home');

Route::group([
    'as' => 'front.'
],function(){
    Route::get('/home',[HomeController::class,'index'])->name('index');
    Route::post('newsub',[NewSubController::class,'store'])->name('newSubscribe');
    Route::match(['post','get'],'search/store',[SearchController::class,'store'])->name('search.store');
    Route::get('category/{slug}',[CategoryController::class,'getCategory'])->name('getCategory');
    Route::get('all-categories',[CategoryController::class,'getAllCategories'])->name('getAllCategories');

    Route::controller(ContactController::class)->name('contact.')->prefix('contact-us/')->group(function(){
        Route::get('','index')->name('index');
        Route::post('store','store')->name('store');
    });
    Route::controller(PostController::class)->prefix('post/')->name('post.')->group(function(){
        Route::get('{slug}','show')->name('show');
        Route::post('store','store')->name('store');
        Route::get('comments/{slug}','getAllComments')->name('getAllComments');
    });
     
    Route::controller(ProfileController::class)->middleware('auth')->prefix('user/')->name('user.')->group(function(){
        Route::get('profile','show')->name('profile');
        Route::post('createPost','getPostForm')->name('getPostForm');

        Route::get('edit/post/{slug}','postEdit')->name('post.edit');
        Route::post('updatePost','updatePost')->name('post.update');
    
    
    });
       

});
Auth::routes();

Route::get('/homes', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
