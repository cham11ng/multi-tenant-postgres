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

use App\Http\Facades\PGSchema;

Route::group(
    [
        'domain'     => '{tenant}.' . config('app.url'),
        'middleware' => 'select-schema'
    ],
    function () {
        // Authentication Routes...
        $this->get('/', 'Auth\LoginController@showLoginForm')->name('login');
        $this->post('/', 'Auth\LoginController@login');
        $this->post('logout', 'Auth\LoginController@logout')->name('logout');

        // Password Reset Routes...
        $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        $this->post('password/reset', 'Auth\ResetPasswordController@reset');

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
        $this->get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
        $this->post('/register', 'Auth\RegisterController@register');
    }
);
