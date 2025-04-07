<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;


Route::get('/home', function () {
    return view('home');
});
Route::get('/', function () {
    return view('home');
});
