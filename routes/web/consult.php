<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('student')->group(function () {
    Route::get('/list', 'StudentController@list')->name('consult.student.list');
    Route::get('/select/lecturer', 'StudentController@selectLecturer')->name('consult.student.select.lecturer');
});