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

Route::prefix('district')->group(function () {
    Route::get('/list', 'DistrictController@list')->name('area.district.list');
    Route::get('/data', 'DistrictController@data')->name('area.district.data');
    Route::get('/get/data', 'DistrictController@getData')->name('area.district.get.data');
    
    Route::get('/get/provinces', 'DistrictController@getProvinces')->name('area.district.get.provinces');
    
    Route::post('/create', 'DistrictController@create')->name('area.district.create.submit');
    Route::put('/update', 'DistrictController@update')->name('area.district.update.submit');
    Route::delete('/delete', 'DistrictController@delete')->name('area.district.delete.submit');
});

Route::prefix('subdistrict')->group(function () {
    Route::get('/list', 'SubdistrictController@list')->name('area.subdistrict.list');
    Route::get('/data', 'SubdistrictController@data')->name('area.subdistrict.data');
    Route::get('/get/data', 'SubdistrictController@getData')->name('area.subdistrict.get.data');
    
    Route::get('/get/districts', 'SubdistrictController@getDistricts')->name('area.subdistrict.get.districts');
    
    Route::post('/create', 'SubdistrictController@create')->name('area.subdistrict.create.submit');
    Route::put('/update', 'SubdistrictController@update')->name('area.subdistrict.update.submit');
    Route::delete('/delete', 'SubdistrictController@delete')->name('area.subdistrict.delete.submit');
});

Route::prefix('village')->group(function () {
    Route::get('/list', 'VillageController@list')->name('area.village.list');
    Route::get('/data', 'VillageController@data')->name('area.village.data');
    Route::get('/get/data', 'VillageController@getData')->name('area.village.get.data');
    
    Route::get('/get/subdistricts', 'VillageController@getSubdistricts')->name('area.village.get.subdistricts');
    
    Route::post('/create', 'VillageController@create')->name('area.village.create.submit');
    Route::put('/update', 'VillageController@update')->name('area.village.update.submit');
    Route::delete('/delete', 'VillageController@delete')->name('area.village.delete.submit');
});