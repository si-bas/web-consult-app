<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('faculty')->group(function () {
    Route::get('/list', 'FacultyController@list')->name('university.faculty.list');
    Route::get('/data', 'FacultyController@data')->name('university.faculty.data');
    Route::get('/get/data', 'FacultyController@getData')->name('university.faculty.get.data');
    
    Route::post('/create', 'FacultyController@create')->name('university.faculty.create.submit');
    Route::put('/update', 'FacultyController@update')->name('university.faculty.update.submit');
    Route::delete('/delete', 'FacultyController@delete')->name('university.faculty.delete.submit');
});

Route::prefix('major')->group(function () {
    Route::get('/list', 'MajorController@list')->name('university.major.list');
    Route::get('/data', 'MajorController@data')->name('university.major.data');
    Route::get('/get/data', 'MajorController@getData')->name('university.major.get.data');
    
    Route::get('/get/faculties', 'MajorController@getFaculties')->name('university.major.get.faculties');
    
    Route::post('/create', 'MajorController@create')->name('university.major.create.submit');
    Route::put('/update', 'MajorController@update')->name('university.major.update.submit');
    Route::delete('/delete', 'MajorController@delete')->name('university.major.delete.submit');
});