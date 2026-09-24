<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JadwalStylistController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\StylistController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\TreatmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Customer\BookingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CUSTOMER (publik) — alur booking sesuai mobile flow di dokumen perencanaan
|--------------------------------------------------------------------------
*/
Route::get('/', [BookingController::class, 'welcome'])->name('home');

// Route Halaman Informasi Statis
Route::get('/tentang-kami', function () {
    return view('customer.about');
})->name('about');

Route::get('/hubungi-kami', function () {
    return view('customer.contact');
})->name('contact');

// Route Halaman Syarat & Ketentuan
Route::get('/syarat-ketentuan', function () {
    return view('customer.terms');
})->name('terms');

Route::prefix('booking')->name('booking.')->group(function () {
    // Route Katalog Seluruh Stylist (Publik)
    Route::get('/all-stylists', [BookingController::class, 'allStylists'])->name('allStylists');

    Route::get('/treatments', [BookingController::class, 'treatments'])->name('treatments');
    Route::get('/treatments/{treatment}', [BookingController::class, 'treatmentShow'])->name('treatments.show');
    Route::get('/treatments/{treatment}/stylists', [BookingController::class, 'stylists'])->name('stylists');
    Route::get('/treatments/{treatment}/stylists/{stylist}/date', [BookingController::class, 'bookingDate'])->name('date');
    Route::get('/treatments/{treatment}/stylists/{stylist}/time', [BookingController::class, 'bookingTime'])->name('time');
    Route::get('/treatments/{treatment}/stylists/{stylist}/form', [BookingController::class, 'bookingForm'])->name('form');
    Route::post('/treatments/{treatment}/stylists/{stylist}/store', [BookingController::class, 'bookingStore'])->name('store');
    Route::get('/success/{code}', [BookingController::class, 'bookingSuccess'])->name('success');

    Route::get('/status', [BookingController::class, 'statusForm'])->name('status.form');
    Route::post('/status', [BookingController::class, 'statusShow'])->name('status.show');
    Route::get('/status/{code}', [BookingController::class, 'statusByCode'])->name('status.show.code');
    Route::post('/reservations/{reservation}/cancel', [BookingController::class, 'cancel'])->name('cancel');

    Route::get('/history', [BookingController::class, 'history'])->name('history');
});

/*
|--------------------------------------------------------------------------
| AUTH ADMIN
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN / KASIR — dilindungi middleware admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    Route::get('/treatments', [TreatmentController::class, 'index'])->name('treatments.index');
    Route::post('/treatments', [TreatmentController::class, 'store'])->name('treatments.store');
    Route::put('/treatments/{treatment}', [TreatmentController::class, 'update'])->name('treatments.update');
    Route::delete('/treatments/{treatment}', [TreatmentController::class, 'destroy'])->name('treatments.destroy');

    Route::get('/stylists', [StylistController::class, 'index'])->name('stylists.index');
    Route::post('/stylists', [StylistController::class, 'store'])->name('stylists.store');
    Route::put('/stylists/{stylist}', [StylistController::class, 'update'])->name('stylists.update');
    Route::delete('/stylists/{stylist}', [StylistController::class, 'destroy'])->name('stylists.destroy');

    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations/check-availability', [ReservationController::class, 'checkAvailability'])->name('reservations.check');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::put('/reservations/{reservation}/status', [ReservationController::class, 'updateStatus'])->name('reservations.status');

    Route::post('/reservations/{reservation}/transaction', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::put('/transactions/{transaction}/status', [TransactionController::class, 'updateStatus'])->name('transactions.status');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
    Route::get('/reports/history', [ReportController::class, 'history'])->name('reports.history');
    Route::get('/reports/customers/{customer}/history', [ReportController::class, 'customerHistory'])->name('reports.customer-history');

    Route::get('/jadwal-stylist', [JadwalStylistController::class, 'index'])->name('jadwal-stylist.index');
});