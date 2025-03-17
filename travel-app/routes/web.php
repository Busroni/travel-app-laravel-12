<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\HistoryTravelController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;

// Halaman utama
Route::get('/', function () {  return view('pages.home'); })->name('home');

Route::get('/travel', function () { return view('pages.travel'); })->name('travel');

Route::get('/login', function () { return view('auth.login'); })->name('login');
Route::post('/login', [AuthController::class, 'login']) // Maksimal 5 percobaan per menit
    ->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

//Register Customer
Route::get('/register', function () { return view('auth.register');})->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/ubah-password/user', [AuthController::class, 'editPassword'])->name('user.password.edit');
    Route::get('/ubah-password/admin', [AuthController::class, 'adminEditPassword'])->name('admin.password.edit');
    Route::post('/ubah-password', [AuthController::class, 'updatePassword'])->name('password.update');
});

//Register Admin
Route::middleware('auth')->group(function () {
    Route::get('/admin/add', [AdminController::class, 'create'])->name('admin.add');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::fallback(function () { return response()->view('errors.404', [], 404); });

Route::get('/admin/dashboard', [TravelController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/travel/create', [TravelController::class, 'create'])->name('admin.travel.create');
Route::post('/admin/travel', [TravelController::class, 'store'])->name('admin.travel.store');
Route::get('/admin/travel/{id}/edit', [TravelController::class, 'edit'])->name('admin.travel.edit');
Route::put('/admin/travel/{id}', [TravelController::class, 'update'])->name('admin.travel.update');
Route::delete('/admin/travel/{id}', [TravelController::class, 'destroy'])->name('admin.travel.delete');
Route::get('/admin/history', [HistoryTravelController::class, 'index'])->name('admin.history');


Route::get('/customer/dashboard', [HistoryTravelController::class, 'userTravelList'])->name('customer.dashboard');
Route::get('/customer/travel', [HistoryTravelController::class, 'userTravel'])->name('customer.travel');
Route::post('/customer/add-new-travel', [HistoryTravelController::class, 'store'])->name('customer.new.travel');
Route::get('/customer/add-travel', [TravelController::class, 'listTravel'])->name('customer.add-travel');
Route::get('/customer/invoice/{id}', [InvoiceController::class, 'show'])->name('customer.invoice');

Route::get('/customer/empty', function () { return view('pages.empty'); })->name('customer.empty');

Route::get('/bayar/{id}', [InvoiceController::class, 'showPaymentPage'])->name('bayar');
Route::post('/bayar/{id}', [InvoiceController::class, 'storePayment'])->name('proses.bayar');

Route::get('/cetak-tiket/{id}', [TicketController::class, 'printTicket'])->name('cetak.tiket');
