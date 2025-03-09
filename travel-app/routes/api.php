<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\TravelController;
use App\Http\Controllers\HistoryTravelController;
use App\Http\Controllers\InvoiceController;

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login-account', 'login');
});

Route::middleware(['auth:sanctum'])->post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->get('/history', [HistoryTravelController::class, 'userTravel']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/travel', [TravelController::class, 'ApiIndex']); // GET Semua Travel
    Route::post('/travel', [TravelController::class, 'store']); // POST Tambah Travel
    Route::get('/travel/{id}', [TravelController::class, 'show']); // GET Travel by ID
    Route::put('/travel/{id}', [TravelController::class, 'update']); // PUT Update Travel
    Route::delete('/travel/{id}', [TravelController::class, 'destroy']); // DELETE Hapus Travel
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/history_travel', [HistoryTravelController::class, 'index']); // GET Semua History
    Route::post('/history_travel', [HistoryTravelController::class, 'store']); // POST Tambah History
    Route::get('/history_travel/{id}', [HistoryTravelController::class, 'show']); // GET History by ID
    Route::put('/history_travel/{id}', [HistoryTravelController::class, 'update']); // PUT Update History
    Route::delete('/history_travel/{id}', [HistoryTravelController::class, 'destroy']); // DELETE Hapus History
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/invoice', [InvoiceController::class, 'index']); // GET Semua Invoice
    Route::post('/invoice', [InvoiceController::class, 'store']); // POST Tambah Invoice
    Route::get('/invoice/{id}', [InvoiceController::class, 'show']); // GET Invoice by ID
    Route::put('/invoice/{id}', [InvoiceController::class, 'update']); // PUT Update Invoice
    Route::delete('/invoice/{id}', [InvoiceController::class, 'destroy']); // DELETE Hapus Invoice
});



