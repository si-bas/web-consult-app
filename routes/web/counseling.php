<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('form')->group(function () {
    Route::get('/fill', 'FormController@fill')->name('counseling.form.fill');
    Route::post('/submit', 'FormController@submit')->name('counseling.form.submit');
});