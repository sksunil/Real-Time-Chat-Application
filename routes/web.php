<?php

Route::get('chat', 'ChatController@chat');
Route::get('send', 'ChatController@send');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
