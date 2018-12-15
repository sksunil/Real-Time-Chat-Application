<?php

Route::get('chat', 'ChatController@chat');
Route::post('send', 'ChatController@send');

Route::post('getOldMessages', 'ChatController@getOldMessages');
Route::post('saveToSession', 'ChatController@saveToSession');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
