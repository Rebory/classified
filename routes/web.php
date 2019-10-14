<?php

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

Route::get('/', 'FrontController@index')->name('index');

Route::get('/home', 'HomeController@index')->name('home');

//USER ROUTES
Route::group([ 'prefix' => 'user',  'middleware' => ['web',  'auth' ]], function() {
    Route::get('my-profile','UserController@myProfile')->name('view.profile');
    Route::post('change-my-password','UserController@changePassword')->name('change.my.password');

    Route::resource('ad','AdController');

});
//END


//END HOTEL ADMIN ROUTES


//EDITOR ROUTES
Route::group(['prefix' => 'editor',  'middleware' =>  ['auth', 'is_city' ]], function() {

});
//END EDITOR ROUTES

// ADMIN ROUTES
Route::group(['prefix' => 'manager',  'middleware' =>  [ 'auth','is_admin']], function() {

});

//SUPER ADMIN ROUTES
    Route::group(['prefix' => 'admin',  'middleware' =>  ['auth', 'is_super_admin' ]], function() {
    Route::resource('users','UserController');
    Route::post('user-activation','UserController@activation')->name('user.activation');
    Route::get('login-details','UserController@logDetails')->name('super.admin.log.details');

    Route::resource('category','CategoryController');
    Route::post('category-activation','CategoryController@activation')->name('category.activation');

    Route::resource('attribute','AttributeController');
    Route::resource('attribute-detail','AttributeDetailController');
    Route::resource('locations','LocationController');

});
//END SUPER ADMIN ROUTES


Route::get('/logout', 'HomeController@logout')->name('logout');
Auth::routes();

Route::get('/clear', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});
