<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('province')->group(function () {
    Route::get('/list', 'ProvinceController@list')->name('area.province.list');
    Route::get('/data', 'ProvinceController@data')->name('area.province.data');
    
    Route::post('/create', 'ProvinceController@create')->name('area.province.create.submit');
});