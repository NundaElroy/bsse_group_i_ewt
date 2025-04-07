<?php

use Illuminate\Support\Facades\Route;

Route::get('/book_ticket', function () { return view('tickets.book_ticket');
})->name('book_ticket');


Route::get('/', function () {
    return view('home');
});

