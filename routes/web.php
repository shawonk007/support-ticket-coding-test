<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});

Route::middleware('auth')->group( function () {
    Route::prefix('messages')->name('messages.')->group( function () {
        Route::post('/send', [MessageController::class, 'send'])->name('send');
        Route::get('/fetch/{ticketId}', [MessageController::class, 'fetch'])->name('fetch');
    });
});

Route::middleware('auth', 'customer')->group( function () {
    Route::get('/dashboard', function () {
        $title = "Dashboard";
        return view('customer.dashboard', get_defined_vars());
    })->name('dashboard');
    Route::prefix('tickets')->name('tickets.')->group( function () {
        Route::get('/', [TicketController::class, 'tickets'])->name('customer');
        Route::post('/store', [TicketController::class, 'store'])->name('store');
        Route::get('/{id}/messages', [MessageController::class, 'messages'])->name('messages');
    });
});

Route::middleware('auth', 'admin')->prefix('admin')->group( function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', [ProfileController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [UserController::class, 'users'])->name('users.index');
    Route::get('/customers', [UserController::class, 'customers'])->name('customers.index');
    Route::prefix('tickets')->name('tickets.')->group( function () {
        Route::get('/', [TicketController::class, 'index'])->name('index');
        Route::get('/opened', [TicketController::class, 'opened'])->name('opened');
        Route::patch('/update/{id}', [TicketController::class, 'update'])->name('update');
        Route::patch('/closed/{id}', [TicketController::class, 'closed'])->name('closed');
        Route::get('/{id}/messages', [MessageController::class, 'index'])->name('history');
    });
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
