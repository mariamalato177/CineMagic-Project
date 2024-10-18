<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\TheaterController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\AdministrativeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\GenreController;


Route::get('/', [HomeController::class, 'index'])->name('home');



// Verified users:
Route::middleware('auth', 'verified')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/tickets/{purchase}', [TicketController::class, 'showTickets'])->name('tickets.showTickets');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/photo/destroy', [ProfileController::class, 'destroyPhoto'])->name('profile.photo.destroy');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('can:admin')->group(function () {

        Route::resource('genres', GenreController::class);

        Route::get('purchases/index', [PurchaseController::class, 'management'])->name('purchases.index');

        Route::get('users/customers', [UserController::class, 'list'])->name('users.list');
        Route::post('users/create', [UserController::class, 'storeNewUser'])->name('users.storeNewUser');
        Route::delete('users/{user}/photo', [UserController::class, 'destroyPhoto'])->name('users.photo.destroy');
        Route::resource('users', UserController::class);

        Route::patch('users/{user}/block', [UserController::class, 'block'])->name('users.block');
        Route::patch('users/{user}/unblock', [UserController::class, 'unblock'])->name('users.unblock');

        Route::put('movies/{movie}/poster/deletePoster', [MovieController::class, 'deletePoster'])->name('movies.posterDelete');
        Route::resource('movies', MovieController::class)->except(['index', 'show']);
        Route::resource('screenings', ScreeningController::class)->except(['index', 'show']);
        Route::resource('theaters', TheaterController::class)->except(['index', 'show']);


        Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');
        Route::get('/reports/sales_by_month', [ReportsController::class, 'salesByMonth'])->name('reports.sales_by_month');
        Route::get('/reports/occupancy_rate', [ReportsController::class, 'occupancyRate'])->name('reports.occupancy_rate');
        Route::post('/reports/export', [ReportsController::class, 'export'])->name('reports.export');

    });

    Route::middleware('can:empA')->group(function () {
        Route::get('/screenings/{screening}/tickets', [ScreeningController::class, 'showTickets'])->name('screenings.showTickets');
    });

    Route::middleware('can:employee')->group(function () {
        Route::post('tickets/{ticket}/invalidate', [TicketController::class, 'invalidateTicket'])->name('tickets.invalidate');
        Route::get('/tickets/show/{ticket}', [TicketController::class, 'showQr'])->name('tickets.showQrCode');
        Route::get('/tickets/validation/{qrcode_url}', [TicketController::class, 'validation'])->name('tickets.validation');
    });

    Route::middleware('can:customer')->group(function () {
        Route::get('purchases/myPurchases', [PdfController::class, 'myPdf'])->name('purchases.myPurchases');

    });

});


Route::get('/movies/{movie}/screenings', [MovieController::class, 'showScreenings'])->name('movies.screenings');

Route::resource('movies', MovieController::class)->only(['index', 'show']);
Route::resource('theaters', TheaterController::class)->only(['index', 'show']);
Route::resource('screenings', ScreeningController::class)->only(['index', 'show']);




Route::resource('tickets', TicketController::class)->only(['index','show']);


// Add a ticket to the cart:
Route::post('cart/{screeningId}', [CartController::class, 'addToCart'])
    ->name('cart.add');
Route::delete('cart/{seatId}/{screeningId}', [CartController::class, 'removeFromCart'])
 ->name('cart.remove');
Route::get('cart', [CartController::class, 'show'])->name('cart.show');
Route::post('cart', [CartController::class, 'confirm'])->name('cart.confirm');
Route::delete('cart', [CartController::class, 'destroy'])->name('cart.destroy');
Route::get('cart/form', [CartController::class, 'form'])->name('cart.form');



Route::get('invoices/invoice/{purchase}', [PdfController::class, 'generatePdf'])->name('pdf.generatePdf');
Route::get('/pdf_purchases/{filename}', [PdfController::class, 'viewPdf'])->name('purchases.viewPdf');








require __DIR__ . '/auth.php';
