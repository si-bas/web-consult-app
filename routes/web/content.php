<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('required')->group(function () {
    Route::get('/powerpoint', 'RequiredController@powerpoint')->name('content.required.powerpoint');
    Route::get('/powerpoint/download', 'RequiredController@powerpointDownload')->name('content.required.powerpoint.download');
    
    Route::get('/check', 'RequiredController@check')->name('content.required.check');
    Route::get('/show/video', 'RequiredController@showVideo')->name('content.required.show.video');
    Route::get('/next/video', 'RequiredController@nextVideo')->name('content.required.next.video');
});