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