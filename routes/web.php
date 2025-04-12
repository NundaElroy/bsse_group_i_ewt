<?php

use App\Http\Controllers\BookTicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketTypeController; // Ensure this class exists in the specified namespace
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ViewBookingsController;
use App\Http\Controllers\VisitorsController;
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

//book tickets on the user view 
Route::get('/book_ticket', [BookTicketController::class, 'index'])->name('book_ticket');
Route::post('/book_ticket', [BookTicketController::class, 'store'])->name('book_ticket.store');




//admin view routes
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/admin/tickets', [TicketTypeController::class, 'index'])->name('tickets');

//vistors
Route::get('/admin/visitors', [VisitorsController::class, 'index'])->name('visitors');

//bookings
Route::get('/admin/bookings', [ViewBookingsController::class, 'index'])->name('bookings');
