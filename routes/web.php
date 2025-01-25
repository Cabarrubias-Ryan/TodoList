<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;

Route::get('/', function () {
    return view('auth/welcome');
})->name('welcome');

Route::get('/home', function () {
    return view('content/home');
});



// Route to redirect to Google's OAuth page
Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('auth.google.redirect');

// Route to handle the callback from Google
Route::get('/auth/google/call-back', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');

Route::get('home/logout', [GoogleAuthController::class, 'logout'])->name('logout');
