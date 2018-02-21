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

//Home Page
Route::get('/', 'HomeController@index');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('profile', 'UserController@profile');
Route::post('profile', 'UserController@postAuth');

Route::get('/home', 'HomeController@redirect')->name('home');

//Dashboard Routes...
Route::get('/dashboard', 'Dashboard\DashboardController@showDashboardPreviewPage')->middleware(\App\Http\Middleware\CheckIfAdmin::class);

//Dashboard CMS Pages Routes...
Route::get('/dashboard/pages', 'Dashboard\CMS\WebsitePagesController@showPagesList')->middleware(\App\Http\Middleware\CheckIfAdmin::class);
Route::get('/dashboard/pages/create', 'Dashboard\CMS\WebsitePagesController@showCreateNewPageForm')->middleware(\App\Http\Middleware\CheckIfAdmin::class);
Route::post('/dashboard/pages/create', 'Dashboard\CMS\WebsitePagesController@createNewPage')->middleware(\App\Http\Middleware\CheckIfAdmin::class);
Route::get('/dashboard/pages/confirmdeletepage/{page_id}', 'Dashboard\CMS\WebsitePagesController@confirmPageDelete')->middleware(\App\Http\Middleware\CheckIfAdmin::class);
Route::post('/dashboard/pages/deletepage/{page_id}', 'Dashboard\CMS\WebsitePagesController@deletePage')->middleware(\App\Http\Middleware\CheckIfAdmin::class);
