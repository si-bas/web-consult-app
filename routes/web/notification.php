<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('badge')->group(function () {
    Route::get('/user/unverified/count', 'BadgeController@userUnverifiedCount')->name('notification.badge.user.unverified.count');
});