<?php

use App\Http\Controllers\{
    RegistrarController,
    CashierController,
};

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

Route::view('/', 'welcome');

Route::get('/dashboard', function () {
})->middleware(['auth', 'verified', 'role'])->name('dashboard');

Route::middleware(['auth', 'verified', 'role:admin,registrar'])
    ->group(function () {
        Route::get('/registrar/dashboard', [RegistrarController::class, 'index'])->name('registrar.dashboard');
        Route::get('/registrar/users', [RegistrarController::class, 'users'])->name('registrar.users');

        // Users
        Route::patch('/registrar/users/{id}', [RegistrarController::class, 'updateUser'])->name('update.user');
    });

Route::middleware(['auth', 'verified', 'role:admin,cashier'])
    ->group(function () {
        Route::get('/cashier/dashboard', [CashierController::class, 'index'])->name('cashier.dashboard');
    });

Route::get('/waiting-for-confirmation', function () {
    return view('waiting-for-confirmation');
})->middleware(['auth', 'verified', 'role:'])->name('waiting-for-confirmation');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
