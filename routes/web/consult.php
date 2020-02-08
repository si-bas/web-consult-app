<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('student')->group(function () {
    Route::get('/list', 'StudentController@list')->name('consult.student.list');
    Route::get('/chat', 'StudentController@chat')->name('consult.student.chat');
    Route::get('/get/messages', 'StudentController@getMessages')->name('consult.student.get.messages');
    Route::post('/save/messages', 'StudentController@saveMessage')->name('consult.student.save.messages.submit');
    
    Route::get('/select/lecturer', 'StudentController@selectLecturer')->name('consult.student.select.lecturer');
    Route::get('/data/lecturer', 'StudentController@dataLecturer')->name('consult.student.data.lecturer');
    Route::get('/detail/lecturer', 'StudentController@detailLecturer')->name('consult.student.detail.lecturer');
    
    Route::get('/select/schedule', 'StudentController@selectSchedule')->name('consult.student.select.schedule');
});