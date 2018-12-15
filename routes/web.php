<?php

Route::get('chat', 'ChatController@chat');
Route::post('send', 'ChatController@send');
Route::post('getOldMessages', 'ChatController@getOldMessages');
Route::post('saveToSession', 'ChatController@saveToSession');
Route::post('deleteSession', 'ChatController@deleteSession');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
