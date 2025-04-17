<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use App\Http\Controllers\ContactController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    //added secure form submission
    public function register(): void
    {
    //     Route::post('/contact/submit', [ContactController::class, 'store'])
    // ->name('contact.submit')
    // ->middleware('throttle:10,1');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
