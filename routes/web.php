<?php

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::resource('flyers', 'FlyersController');

Route::post('flyers/{flyer}/photos', 'FlyersController@addPhoto')->name('photo.upload');