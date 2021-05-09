<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin-dashboard', 'HomeController@index')->name('home');
Route::any('/{any}', 'HomeController@index')->where('any', '^(?!api).*');

