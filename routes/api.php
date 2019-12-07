<?php

Route::resource('schedules', 'Api\ScheduleController')->except([
    'create','edit'
]);

Route::get('users', 'Api\UserController@index');
Route::post('user', 'Api\UserController@store');

Route::get('status', 'Api\StatusController@index');