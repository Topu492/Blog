<?php
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
Route::get('/','HomeController@index')->name('home');
Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');

Route::post('subscriber/','SubscriberController@store')->name('subscriber.store');

Route::get('/search','SearchController@search')->name('search');
//search
Route::get('posts','PostController@index')->name('posts.index');

//Author
Route::get('profile/{username}','AuthorController@profile')->name('author.profile');


Route::get('post/{slug}','PostController@details')->name('post.details');
Route::get('category/{slug}','PostController@postbycategory')->name('category.posts');
Route::get('tag/{slug}','PostController@postbytag')->name('tag.posts');


Route::group(['middleware'=>['auth']],function(){
	Route::post('favorite/{id}/add', 'FavoriteController@add')->name('favorite.add');
	Route::post('comment/{id}', 'CommentController@store')->name('comment.store');

});


Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']],function(){
	Route::get('dashboard','DashboardController@index')->name('dashboard');


	Route::get('comment','CommentController@index')->name('comment.index');
	Route::post('comment/{id}','CommentController@delete')->name('comment.delete');

	Route::get('settings','SettingsController@index')->name('settings.index');
	Route::post('profile-update','SettingsController@profileupdate')->name('profile.update');
	Route::post('password-update','SettingsController@passwordupdate')->name('password.update');

	Route::get('/authors','AuthorsController@index')->name('author.index');
	Route::delete('/authors/{id}','AuthorsController@destroy')->name('author.destroy');

	Route::get('favorite','FavoriteController@index')->name('favorite.index');

	Route::resource('tag','TagController');
	Route::resource('category','CategoryController');
	Route::resource('post','PostController');


	Route::get('/subscriber','SubscriberController@index')->name('subscriber.index');
	Route::delete('subscriber/{subscriber}','SubscriberController@destroy')->name('subscriber.destroy');


	Route::get('/pending/post','PostController@pending')->name('post.pending');
	Route::post('post/approve/{id}','PostController@approve')->name('post.approve');

});


Route::group(['as'=>'author.','prefix'=>'author','namespace'=>'Author','middleware'=>['auth','author']],function(){
	Route::get('dashboard','DashboardController@index')->name('dashboard');

	Route::get('favorite','FavoriteController@index')->name('favorite.index');

	Route::get('comment','CommentController@index')->name('comment.index');
	Route::post('comment/{id}','CommentController@delete')->name('comment.delete');

	
	Route::get('settings','SettingsController@index')->name('settings.index');
	Route::post('profile-update','SettingsController@profileupdate')->name('profile.update');
	Route::post('password-update','SettingsController@passwordupdate')->name('password.update');


	Route::resource('post','PostController');
});

View::composer('layouts.frontend.partial.footer',function($view){
	$categories=App\Category::all();
	$view->with('categories',$categories);

});