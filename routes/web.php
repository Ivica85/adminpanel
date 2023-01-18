<?php

use App\Http\Controllers\AdminMediasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();



Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);



Route::group(['middleware'=>'admin'],function(){


    Route::get('/admin',[App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');

    Route::resource('admin/users','App\Http\Controllers\AdminUsersController');
    Route::resource('admin/posts','App\Http\Controllers\AdminPostsController');


    Route::resource('admin/categories','App\Http\Controllers\AdminCategoriesController');

    Route::resource('admin/comments','App\Http\Controllers\PostCommentsController');

    Route::resource('admin/comment/replies','App\Http\Controllers\CommentRepliesController');

    Route::resource('admin/media','App\Http\Controllers\AdminMediasController');
    Route::delete('delete/media','App\Http\Controllers\AdminMediasController@deleteMedia')->name('delete.media');
});


Route::group(['middleware'=>'auth'],function(){
    Route::get('post/{id}',[App\Http\Controllers\HomeController::class, 'post'])->name('home.post');
    Route::post('comment/create',[App\Http\Controllers\PostCommentsController::class,'createComment'])->name('createComment');
    Route::post('comment/reply',[App\Http\Controllers\CommentRepliesController::class,'createReply'])->name('createReply');
});


