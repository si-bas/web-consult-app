<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('consent')->group(function () {
    Route::get('/form', 'ConsentController@form')->name('information.consent.form');
    Route::get('/agree', 'ConsentController@agree')->name('information.consent.agree');
});