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

Route::prefix('fill')->group(function () { 
    Route::get('/check', 'FillController@check')->name('questionnaire.fill.check');
    Route::get('/form', 'FillController@form')->name('questionnaire.fill.form');
    Route::post('/submit', 'FillController@submit')->name('questionnaire.fill.submit');

    Route::get('/done', 'FillController@done')->name('questionnaire.fill.done');
});

Route::prefix('respondent')->group(function () {
    Route::get('/list', 'RespondentController@list')->name('questionnaire.respondent.list');
    Route::get('/data', 'RespondentController@data')->name('questionnaire.respondent.data');
});

Route::prefix('post')->group(function () { 
    Route::get('/check', 'PostController@check')->name('questionnaire.post.check');
    Route::get('/form', 'PostController@form')->name('questionnaire.post.form');
    Route::post('/submit', 'PostController@submit')->name('questionnaire.post.submit');

    Route::get('/done', 'PostController@done')->name('questionnaire.post.done');
});