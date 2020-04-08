<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('questionnaire')->group(function () {
    Route::get('/list', 'QuestionnaireController@list')->name('report.questionnaire.list');    
    Route::get('/data', 'QuestionnaireController@data')->name('report.questionnaire.data');
    
    Route::post('/generate', 'QuestionnaireController@generate')->name('report.questionnaire.generate.submit');
});