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
    Route::get('/detail', 'LecturerController@detail')->name('user.lecturer.detail');
    
    Route::get('/form/create', 'LecturerController@formCreate')->name('user.lecturer.form.create');
    Route::post('/create', 'LecturerController@create')->name('user.lecturer.create.submit');

    Route::get('/form/update', 'LecturerController@formUpdate')->name('user.lecturer.form.update');
    Route::put('/update', 'LecturerController@update')->name('user.lecturer.update.submit');
    
    Route::get('/get/faculties', 'LecturerController@getFaculties')->name('user.lecturer.get.faculties');
    Route::get('/get/majors', 'LecturerController@getMajors')->name('user.lecturer.get.majors');
    Route::get('/check/email', 'LecturerController@checkEmail')->name('user.lecturer.check.email');
});