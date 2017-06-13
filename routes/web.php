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

Route::group(
    [
        'domain'     => '{tenant}.' . config('app.url'),
        'middleware' => 'select-schema'
    ],
    function () {
        // Authentication Routes...
        Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
        Route::post('/', 'Auth\LoginController@login');
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');

        // Password Reset Routes...
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset');

        Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    }
);

Route::group(
    [
        'domain' => config('app.url'),
    ],
    function () {
        Route::get(
            '/',
            function () {
                return view('welcome');
            }
        )->name('home');

        // Registration Routes...
        Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
        Route::post('/register', 'Auth\RegisterController@register');
    }
);
