<?php

use App\Http\Controllers\{
    RegistrarsController,
    CashiersController,
    RequestersController,
    DocumentsController,
    EmailVerificationController,
    CheckoutController,
    ScheduleController,
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

Route::view('/', 'welcome', ['trackingCode' => request()->query('tracking_code')]);
Route::get('/verify-email/{email}', [EmailVerificationController::class, 'verify'])->name('email.verify');
Route::get('/verification-complete', [EmailVerificationController::class, 'index'])->name('verification.complete');
Route::get('/checkout-successful', [CheckoutController::class, 'successful'])->name('checkout.successful');
Route::get('/checkout-failed', [CheckoutController::class, 'failed'])->name('checkout.failed');

Route::get('/dashboard', function () {
})->middleware(['auth', 'verified', 'role'])->name('dashboard');

Route::middleware(['auth', 'verified', 'role:admin,registrar'])
    ->group(function () {
        Route::get('/registrar', [RegistrarsController::class, 'index'])->name('registrar');
        Route::get('/registrar/dashboard', [RegistrarsController::class, 'index'])->name('registrar.dashboard');
        Route::get('/registrar/users', [RegistrarsController::class, 'users'])->name('registrar.users');
        Route::get('/registrar/requests', [RegistrarsController::class, 'requests'])->name('registrar.requests');
        Route::get('/registrar/documents', [RegistrarsController::class, 'documents'])->name('registrar.documents');
        Route::get('/registrar/schedules', [RegistrarsController::class, 'schedules'])->name('registrar.schedules');
        Route::get('/registrar/notifications', [RegistrarsController::class, 'notifications'])->name('registrar.notifications');
        Route::get('/registrar/exports', [RegistrarsController::class, 'exports'])->name('registrar.exports');

        // Documents
        Route::patch('/documents', [DocumentsController::class, 'create'])->name('create.document');
        Route::patch('/documents/{id}', [DocumentsController::class, 'update'])->name('update.document');

        // Schedules
        Route::patch('/schedule', [ScheduleController::class, 'update'])->name('update.schedule');
    });

Route::middleware(['auth', 'verified', 'role:admin,cashier'])
    ->group(function () {
        Route::get('/cashier', [CashiersController::class, 'index'])->name('cashier');
        Route::get('/cashier/dashboard', [CashiersController::class, 'index'])->name('cashier.dashboard');
        Route::get('/cashier/requests', [CashiersController::class, 'requests'])->name('cashier.requests');
        Route::get('/cashier/transactions', [CashiersController::class, 'transactions'])->name('cashier.transactions');
        Route::get('/cashier/notifications', [CashiersController::class, 'notifications'])->name('cashier.notifications');
    });

Route::middleware(['auth', 'verified', 'role:admin,requester'])
->group(function () {
    Route::get('/requester', [RequestersController::class, 'index'])->name('requester');
    Route::get('/requester/dashboard', [RequestersController::class, 'index'])->name('requester.dashboard');
    Route::get('/requester/requests', [RequestersController::class, 'requests'])->name('requester.requests');
    Route::get('/requester/notifications', [RequestersController::class, 'notifications'])->name('requester.notifications');
});


Route::get('/system-logs', function () {
    return view('system-logs');
})->middleware(['auth', 'verified', 'role:admin'])->name('system.logs');

Route::get('/waiting-for-confirmation', function () {
    return view('waiting-for-confirmation');
})->middleware(['auth', 'verified', 'role:confirmation'])->name('waiting-for-confirmation');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
