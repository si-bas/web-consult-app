<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('province')->group(function () {
    Route::get('/list', 'ProvinceController@list')->name('area.province.list');
    Route::get('/data', 'ProvinceController@data')->name('area.province.data');
    Route::get('/get/data', 'ProvinceController@getData')->name('area.province.get.data');
    
    Route::post('/create', 'ProvinceController@create')->name('area.province.create.submit');
    Route::put('/update', 'ProvinceController@update')->name('area.province.update.submit');
    Route::delete('/delete', 'ProvinceController@delete')->name('area.province.delete.submit');
});