<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('student')->group(function () {
    Route::get('/list', 'StudentController@list')->name('consult.student.list');
    
    Route::get('/select/lecturer', 'StudentController@selectLecturer')->name('consult.student.select.lecturer');
    Route::get('/data/lecturer', 'StudentController@dataLecturer')->name('consult.student.data.lecturer');
    Route::get('/detail/lecturer', 'StudentController@detailLecturer')->name('consult.student.detail.lecturer');
    
    Route::get('/select/schedule', 'StudentController@selectSchedule')->name('consult.student.select.schedule');
    
    Route::get('/chat', 'StudentController@chat')->name('consult.student.chat');
    
    Route::get('/get/messages', 'StudentController@getMessages')->name('consult.student.get.messages');
    Route::get('/chat/first/load', 'StudentController@chatFirstLoad')->name('consult.student.chat.first.load');
    Route::get('/get/messages/more', 'StudentController@getMessagesMore')->name('consult.student.get.messages.more');
    
    Route::post('/save/messages', 'StudentController@saveMessage')->name('consult.student.save.messages.submit');
    Route::get('/get/messages/new', 'StudentController@getMessagesNew')->name('consult.student.get.messages.new');
});

Route::prefix('lecturer')->group(function () {
    Route::get('/list', 'LecturerController@list')->name('consult.lecturer.list');
    Route::get('/chat', 'LecturerController@chat')->name('consult.lecturer.chat');

    Route::get('/get/messages', 'LecturerController@getMessages')->name('consult.lecturer.get.messages');
    Route::get('/chat/first/load', 'LecturerController@chatFirstLoad')->name('consult.lecturer.chat.first.load');
    Route::get('/get/messages/more', 'LecturerController@getMessagesMore')->name('consult.lecturer.get.messages.more');

    Route::post('/save/messages', 'LecturerController@saveMessage')->name('consult.lecturer.save.messages.submit');

    Route::get('/get/messages/new', 'LecturerController@getMessagesNew')->name('consult.lecturer.get.messages.new');
});