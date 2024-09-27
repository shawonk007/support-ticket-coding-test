<?php

use App\Http\Controllers\ProfileController;
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

Route::middleware('auth', 'customer')->group( function () {
    Route::get('/dashboard', function () {
        $title = "Dashboard";
        return view('customer.dashboard', get_defined_vars());
    })->name('dashboard');
});

Route::middleware('auth', 'admin')->prefix('admin')->group( function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', [ProfileController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [UserController::class, 'users'])->name('users.index');
    Route::get('/customers', [UserController::class, 'customers'])->name('customers.index');
});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
