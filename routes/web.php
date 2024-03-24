<?php

use App\Http\Controllers\{
    RegistrarsController,
    CashiersController,
    RequestersController,
    UsersController,
    DocumentsController,
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
        Route::get('/registrar', [RegistrarsController::class, 'index'])->name('registrar.dashboard');
        Route::get('/registrar/dashboard', [RegistrarsController::class, 'index'])->name('registrar.dashboard');
        Route::get('/registrar/users', [RegistrarsController::class, 'users'])->name('registrar.users');
        Route::get('/registrar/requests', [RegistrarsController::class, 'requests'])->name('registrar.requests');
        Route::get('/registrar/documents', [RegistrarsController::class, 'documents'])->name('registrar.documents');

        // Users
        Route::patch('/users/{id}', [UsersController::class, 'update'])->name('update.user');

        // Documents
        Route::patch('/documents', [DocumentsController::class, 'create'])->name('create.document');
        Route::patch('/documents/{id}', [DocumentsController::class, 'update'])->name('update.document');
        Route::patch('/process', [DocumentsController::class, 'createProcess'])->name('create.process');
    });

Route::middleware(['auth', 'verified', 'role:admin,cashier'])
    ->group(function () {
        Route::get('/cashier', [CashiersController::class, 'index'])->name('cashier.dashboard');
        Route::get('/cashier/dashboard', [CashiersController::class, 'index'])->name('cashier.dashboard');
    });

Route::middleware(['auth', 'verified', 'role:admin,requester'])
->group(function () {
    Route::get('/requester', [RequestersController::class, 'index'])->name('requester.dashboard');
    Route::get('/requester/dashboard', [RequestersController::class, 'index'])->name('requester.dashboard');
    Route::get('/requester/requests', [RequestersController::class, 'requests'])->name('requester.requests');
});

Route::get('/waiting-for-confirmation', function () {
    return view('waiting-for-confirmation');
})->middleware(['auth', 'verified', 'role:'])->name('waiting-for-confirmation');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
