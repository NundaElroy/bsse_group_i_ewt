<?php

use App\Http\Controllers\BookTicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketTypeController; // Ensure this class exists in the specified namespace
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ViewBookingsController;
use App\Http\Controllers\VisitorsController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EventsController;



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


Route::resource('/locations', LocationController::class);




//admin view routes
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//tickets
Route::get('/admin/tickets', [TicketTypeController::class, 'index'])->name('tickets');
Route::get('/admin/editTicket/{id}', [TicketTypeController::class, 'editTicket'])->name('editTicket');
Route::post('/admin/updateTicket/{id}', [TicketTypeController::class, 'updateTicket'])->name('updateTicket');


//vistors
Route::get('/admin/visitors', [VisitorsController::class, 'index'])->name('visitors');

//bookings
Route::get('/admin/bookings', [ViewBookingsController::class, 'index'])->name('bookings');


//employee
Route::resource('employees', EmployeeController::class);

//events
Route::resource('events', EventsController::class);






