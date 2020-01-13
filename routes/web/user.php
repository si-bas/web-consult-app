<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('student')->group(function () {
    Route::get('/list', 'StudentController@list')->name('user.student.list');
    Route::get('/data', 'StudentController@data')->name('user.student.data');
    
    Route::get('/detail', 'StudentController@detail')->name('user.student.detail');
});