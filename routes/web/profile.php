<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('student')->group(function () {
    Route::get('/complete', 'StudentController@complete')->name('profile.student.complete');
    
    Route::post('/create', 'StudentController@create')->name('profile.student.create.submit');

});