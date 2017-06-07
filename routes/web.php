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
    ['domain' => '{account}.' . config('app.url')],
    function () {
        Route::get(
            '/',
            function ($account) {
                PGSchema::switchTo($account);
                return view('welcome');
            }
        )->name('homepage');
    }
);

Route::get(
    '/',
    function () {
        return view('welcome');
    }
);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/tenants', 'TenantsController');

Route::get(
    'apple',
    function () {
        $result = DB::statement('SET search_path TO apple');
        $query  = DB::select('show search_path');

        return array_pop($query)->search_path;
    }
);

Route::get(
    'ball',
    function () {
        $query = DB::select('show search_path');

        return array_pop($query)->search_path;
    }
);
