<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    Route::get('/list', 'QuestionnaireController@list')->name('questionnaire.list');
    Route::post('/create', 'QuestionnaireController@create')->name('questionnaire.create.submit');
});