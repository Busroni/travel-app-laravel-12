<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\HistoryTravelController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\AuthController;

// Halaman utama
Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/travel', function () {
    return view('pages.travel');
})->name('travel');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.submit');


Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

Route::get('/admin/dashboard', [TravelController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/travel/create', [TravelController::class, 'create'])->name('admin.travel.create');
Route::post('/admin/travel', [TravelController::class, 'store'])->name('admin.travel.store');
Route::get('/admin/travel/{id}/edit', [TravelController::class, 'edit'])->name('admin.travel.edit');
Route::put('/admin/travel/{id}', [TravelController::class, 'update'])->name('admin.travel.update');
Route::delete('/admin/travel/{id}', [TravelController::class, 'destroy'])->name('admin.travel.delete');
Route::get('/admin/history', [HistoryTravelController::class, 'index'])->name('admin.history');


Route::get('/customer/dashboard', [HistoryTravelController::class, 'userTravel'])->name('customer.dashboard');
Route::get('/customer/travel', [HistoryTravelController::class, 'userTravelList'])->name('customer.travel');
Route::get('/customer/invoice/{id}', [InvoiceController::class, 'show'])->name('customer.invoice');
