<?php

use Illuminate\Support\Facades\Route;
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
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::namespace('Auth')->group(function () {
    // Controllers Within The "App\Http\Controllers\Auth" Namespace
    Route::prefix('register')->group(function () {
        Route::post('/', 'RegisterController@store')->name('register.submit');
    
        Route::get('/get/faculties', 'RegisterController@getFaculties')->name('register.get.faculties');
        Route::get('/get/majors', 'RegisterController@getMajors')->name('register.get.majors');
        
        Route::get('/done', 'RegisterController@done')->name('register.done');
    });
});