<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\Auth;

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


Route::get('/', function () {
    $data = '';
    try {
        BD::connection()->getPdo();
        $data =  "Connected successfully to: " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        die("Could not connect to the database. Please check your configuration. error:" . $e );
    }

    return view('welcome')->with('data', $data);

});

/* Route::get('/login', function () {
    return view('auth.login');
})->name('login'); */

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
