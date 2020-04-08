<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('questionnaire')->group(function () {
    Route::get('/list', 'QuestionnaireController@list')->name('report.questionnaire.list');    
    Route::get('/data', 'QuestionnaireController@data')->name('report.questionnaire.data');
    
    Route::post('/generate', 'QuestionnaireController@generate')->name('report.questionnaire.generate.submit');
});

Route::prefix('activity')->group(function () {
    Route::get('/list', 'ActivityController@list')->name('report.activity.list');
    Route::get('/data', 'ActivityController@data')->name('report.activity.data');
    
    Route::post('/send', 'ActivityController@send')->name('report.activity.send.submit');
});