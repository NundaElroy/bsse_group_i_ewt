<?php

use App\Http\Controllers\BookTicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketTypeController; // Ensure this class exists in the specified namespace
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;



//use view routes
Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::get('/book_ticket', [BookTicketController::class, 'index'])->name('book_ticket');




//admin view routes
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/admin/tickets', [TicketTypeController::class, 'index'])->name('tickets');
