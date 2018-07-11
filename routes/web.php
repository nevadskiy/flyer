<?php

Route::get('/', function () {
    return 'Hello world';
})->name('home');



Route::post('/flyers/{flyer}/photos', 'FlyersController@addPhoto')->name('photo.upload');

Route::resource('flyers', 'FlyersController')->except(['show']);
Route::get('{zip}/{street}', 'FlyersController@show');
