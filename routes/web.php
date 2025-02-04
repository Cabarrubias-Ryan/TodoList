<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('auth/welcome');
})->name('login');


// Route to redirect to Google's OAuth page
Route::get('/auth/{provider}/redirect', [AuthController::class, 'redirect'])->name('auth.provider.redirect');

// Route to handle the callback from Google
Route::get('/auth/{provider}/call-back', [AuthController::class, 'callback'])->name('auth.provider.callback');



Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {
        return view('content/home');
    })->name('home');
    Route::get('home/logout', [AuthController::class, 'logout'])->name('logout');
});
