<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('required')->group(function () {
    Route::get('/check', 'RequiredController@check')->name('quiz.required.check');
});