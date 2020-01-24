<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    Route::get('/list', 'QuestionnaireController@list')->name('questionnaire.list');
    Route::get('/data', 'QuestionnaireController@data')->name('questionnaire.list.data');
    
    Route::get('/detail', 'QuestionnaireController@detail')->name('questionnaire.detail');
    
    Route::post('/create', 'QuestionnaireController@create')->name('questionnaire.create.submit');
});

Route::prefix('question')->group(function () {
    Route::get('/form/create', 'QuestionController@formCreate')->name('questionnaire.question.form.create');
});