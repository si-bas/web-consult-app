<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('form')->group(function () {
    Route::get('/fill', 'FormController@fill')->name('evaluation.form.fill');
});