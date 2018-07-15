<?php

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/home', function () {
    return view('pages.home');
})->name('home');


Route::post('/flyers/{flyer}/photos', 'PhotosController@store')->name('photo.upload');

Route::resource('flyers', 'FlyersController')->except(['show']);
Route::get('{zip}/{street}', 'FlyersController@show')->name('flyers.show');

Auth::routes();
