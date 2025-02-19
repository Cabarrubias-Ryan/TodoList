<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('auth/welcome');
})->name('login');


// Route to redirect to Google's OAuth page
Route::get('/auth/{provider}/redirect', [AuthController::class, 'redirect'])->name('auth.provider.redirect');
// Route to handle the callback from Google
Route::get('/auth/{provider}/call-back', [AuthController::class, 'callback'])->name('auth.provider.callback');

Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register/add', [AuthController::class, 'registerAccount'])->name('auth.register.add');

Route::post('/login', [AuthController::class, 'loginAccount'])->name('auth.login');

Route::middleware(['auth'])->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('home/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('home/addtask',[HomeController::class, 'addTask'])->name('task');
    Route::post('home/update', [HomeController::class, 'editTask'])->name('update');
    Route::post('home/delete', [HomeController::class, 'deleteTask'])->name('delete');
});

