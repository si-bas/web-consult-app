<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('required')->group(function () {
    Route::get('/check', 'RequiredController@check')->name('quiz.required.check');
    
    Route::get('/quiz-1', 'RequiredController@quiz1')->name('quiz.required.quiz.one');
    Route::post('/quiz-1/submit', 'RequiredController@quiz1Submit')->name('quiz.required.quiz.one.submit');
    
    Route::get('/quiz-2', 'RequiredController@quiz2')->name('quiz.required.quiz.two');
    Route::post('/quiz-2/submit', 'RequiredController@quiz2Submit')->name('quiz.required.quiz.two.submit');

    Route::get('/quiz-3', 'RequiredController@quiz3')->name('quiz.required.quiz.three');
    Route::post('/quiz-3/submit', 'RequiredController@quiz3Submit')->name('quiz.required.quiz.three.submit');
});