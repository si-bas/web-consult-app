<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    Route::get('/list', 'QuestionnaireController@list')->name('questionnaire.list');
    Route::get('/data', 'QuestionnaireController@data')->name('questionnaire.list.data');
    
    Route::get('/detail', 'QuestionnaireController@detail')->name('questionnaire.detail');
    
    Route::post('/create', 'QuestionnaireController@create')->name('questionnaire.create.submit');
    Route::put('/update', 'QuestionnaireController@update')->name('questionnaire.update.submit');
});

Route::prefix('question')->group(function () {
    Route::get('/data', 'QuestionController@data')->name('questionnaire.question.data');
    Route::get('/detail/modal', 'QuestionController@detailModal')->name('questionnaire.question.detail.modal');
    
    Route::get('/form/create', 'QuestionController@formCreate')->name('questionnaire.question.form.create');
    Route::post('/create', 'QuestionController@create')->name('questionnaire.question.create.submit');
    
    Route::get('/form/update', 'QuestionController@formUpdate')->name('questionnaire.question.form.update');
    Route::put('/update', 'QuestionController@update')->name('questionnaire.question.update.submit');
    
    Route::delete('/delete', 'QuestionController@delete')->name('questionnaire.question.delete.submit');
});