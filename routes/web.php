<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\VideoController;
use App\Models\Playlist;
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

// Route::get('/', function () {
//     return view('index', ['title'=>'dekhtamasha']);
// });
Route::get('/', [IndexController::class, 'index'])->name('user.getIndex');
Route::get('/category/{id}', [IndexController::class, 'getVideoWithCategory'])->name('user.getVideoWithCategory');
Route::get('/playlist/{id}', [IndexController::class, 'getVideoWithPlaylist'])->name('user.getVideoWithPlaylist');
Route::post('/like', [IndexController::class, 'like'])->name('user.video.like');
Route::post('/dislike', [IndexController::class, 'dislike'])->name('user.video.dislike');
Route::post('/comment', [CommentController::class, 'store'])->name('user.comment.store');
Route::delete('/comment', [CommentController::class, 'destroy'])->name('user.comment.destroy');
Route::prefix('/watch')->group(function(){
    Route::get('/{token_id}', [IndexController::class, 'getWatch'])->name('user.getWatch');
});
Auth::routes();

Route::get('/admin/home', [App\Http\Controllers\AdminHomeController::class, 'index'])->middleware('role:2')->name('admin.home');
Auth::routes();

Route::get('/admin/home', 'App\Http\Controllers\AdminHomeController@index')->middleware('role:2')->name('admin.dashboard');

Route::group(['middleware' => 'role:2', 'prefix'=>'admin'], function () {
	Route::get('/', [App\Http\Controllers\AdminHomeController::class, 'index'])->name('admin.home');
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	// Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	// Route::get('/video', ['as' => 'video.create', 'uses' => 'App\Http\Controllers\VideoController@index']);
	// Route::get('/video/{id}', ['as' => 'video.edit', 'uses' => 'App\Http\Controllers\VideoController@show']);

	Route::resource('/video', VideoController::class);

	Route::patch('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::patch('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);


	// for admin categories list
	Route::get('/categories', [CategoryController::class, 'getCategories'])->name('admin.getCategories');
	Route::post('/playlist', [PlaylistController::class, 'store'])->name('playlist.store');
	Route::post('/video', [VideoController::class, 'store'])->name('video.store');
});

Route::group(['middleware' => 'role:2'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});

