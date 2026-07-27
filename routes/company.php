<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Company\DashboardController;

Route::prefix('dashboard')->middleware(['auth','company'])->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('company.dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('company.profile');
    Route::put('/profile', [DashboardController::class, 'profileUpdate'])->name('company.profile.update');
    Route::get('/leads', [DashboardController::class, 'leads'])->name('company.leads');
    Route::get('/reviews', [DashboardController::class, 'reviews'])->name('company.reviews');
    Route::get('/analytics', [DashboardController::class, 'analytics'])->name('company.analytics');
    Route::get('/billing', [DashboardController::class, 'billing'])->name('company.billing');
});
