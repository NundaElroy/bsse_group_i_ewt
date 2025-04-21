<?php

use App\Http\Controllers\BookTicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketTypeController; // Ensure this class exists in the specified namespace
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ViewBookingsController;
use App\Http\Controllers\VisitorsController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\UserEventController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MedicalRecordController;

//use view routes
Route::get('/', function () {
    return view('home');
});
//check this 2nd home route later
Route::get('/home', function () {
    return view('home');
});

// Route::get('/contact', function () {
//     return view('contact');
// })->name('contact');

//book tickets on the user view 
Route::get('/book_ticket', [BookTicketController::class, 'index'])->name('book_ticket');
Route::post('/book_ticket', [BookTicketController::class, 'store'])->name('book_ticket.store');

//Events on the web or user view
Route::get('/events', [UserEventController::class, 'index'])->name('evens');

//gallery
Route::get('/gallery', [UserEventController::class, 'gallery'])->name('gallery');
//adding route for form submission
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact/submit', [ContactController::class, 'store'])->name('contact.submit');

//added new trial route

// Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');




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

//locations or habitats
Route::resource('/locations', LocationController::class);

//inventory
Route::resource('inventories', InventoryController::class);

//feedback routes
Route::get('/admin/feedback', [FeedbackController::class, 'index'])->name('admin.feedback.index');
Route::get('/admin/feedback/{id}', [FeedbackController::class, 'show'])->name('admin.feedback.show');

//gallery
Route::resource('galleries', GalleryController::class);

//animal
Route::resource('animals', \App\Http\Controllers\AnimalController::class);
//habitats
Route::resource('habitats', \App\Http\Controllers\HabitatController::class);
//medical records 


Route::resource('medical-records', MedicalRecordController::class);

