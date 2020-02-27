<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('student')->group(function () {
    Route::get('/complete', 'StudentController@complete')->name('profile.student.complete');
    Route::post('/create', 'StudentController@create')->name('profile.student.create.submit');

    Route::get('/detail', 'StudentController@detail')->name('profile.student.detail');
    Route::put('/update', 'StudentController@update')->name('profile.student.update.submit');
    
    Route::get('/get/majors', 'StudentController@getMajors')->name('profile.student.get.majors');
});