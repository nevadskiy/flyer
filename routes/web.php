<?php

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::resource('flyers', 'FlyersController');