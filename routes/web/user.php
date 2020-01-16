<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('student')->group(function () {
    Route::get('/list', 'StudentController@list')->name('user.student.list');
    Route::get('/data', 'StudentController@data')->name('user.student.data');
    
    Route::post('/verify', 'StudentController@verify')->name('user.student.verify.submit');
    
    Route::get('/detail', 'StudentController@detail')->name('user.student.detail');
});

Route::prefix('lecturer')->group(function () {
    Route::get('/list', 'LecturerController@list')->name('user.lecturer.list');
    Route::get('/data', 'LecturerController@data')->name('user.lecturer.data');
    
    Route::get('/form/create', 'LecturerController@formCreate')->name('user.lecturer.form.create');
});