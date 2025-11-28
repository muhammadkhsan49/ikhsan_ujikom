<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\VerificationController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ExportController;

// Welcome page
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->isAdmin()) {
            return redirect('/admin/');
        }
        return redirect('/dashboard');
    }
    return view('welcome');
})->name('welcome');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// User Routes
Route::middleware(['auth', 'user.access'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [RegistrationController::class, 'dashboard'])->name('dashboard');
    
    // Registration
    Route::get('/registration/create', [RegistrationController::class, 'create'])->name('registration.create');
    Route::post('/registration', [RegistrationController::class, 'store'])->name('registration.store');
    Route::get('/registration/{registration}/edit', [RegistrationController::class, 'edit'])->name('registration.edit');
    Route::delete('/registration/{registration}', [RegistrationController::class, 'destroy'])->name('registration.destroy');
    
    // Registration History
    Route::get('/registration-history', [RegistrationController::class, 'history'])->name('registration.history');
    Route::get('/registration/{registration}', [RegistrationController::class, 'show'])->name('registration.show');
    Route::get('/registration/{registration}/pdf', [RegistrationController::class, 'printPdf'])->name('registration.pdf');
    
    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
});

// Admin Routes
Route::middleware(['auth', 'admin.access'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Verification
    Route::prefix('verification')->name('verification.')->group(function () {
        Route::get('/', [VerificationController::class, 'index'])->name('index');
        Route::get('/{registration}', [VerificationController::class, 'show'])->name('show');
        Route::post('/{registration}/verify', [VerificationController::class, 'verify'])->name('verify');
        Route::post('/{registration}/reject', [VerificationController::class, 'reject'])->name('reject');
    });
    
    // Schedules
    Route::resource('schedules', ScheduleController::class);
    
    // Notifications
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::post('/{notification}/read', [NotificationController::class, 'markAsRead'])->name('read');
        Route::delete('/{notification}', [NotificationController::class, 'destroy'])->name('destroy');
    });
    
    // Export
    Route::prefix('export')->name('export.')->group(function () {
        Route::get('/excel', [ExportController::class, 'exportExcel'])->name('excel');
        Route::get('/pdf', [ExportController::class, 'exportPdf'])->name('pdf');
    });
});
