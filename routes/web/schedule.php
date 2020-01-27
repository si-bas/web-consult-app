<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('availability')->group(function () {
    Route::get('/list', 'AvailabilityController@list')->name('schedule.availability.list');
    Route::get('/data', 'AvailabilityController@data')->name('schedule.availability.data');
    
    Route::get('/form/create', 'AvailabilityController@formCreate')->name('schedule.availability.form.create');
    Route::post('/create', 'AvailabilityController@create')->name('schedule.availability.create.submit');

    Route::get('/form/update', 'AvailabilityController@formUpdate')->name('schedule.availability.form.update');
    Route::put('/update', 'AvailabilityController@update')->name('schedule.availability.update.submit');
    
    Route::delete('/delete', 'AvailabilityController@delete')->name('schedule.availability.delete.submit');
    
    Route::get('/get/days', 'AvailabilityController@getDays')->name('schedule.availability.get.days');
});