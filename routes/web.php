<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HaulController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:Developer|Owner'])
    ->prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {
        Route::resource('owners', OwnerController::class);
        Route::resource('partners', PartnerController::class);
        Route::resource('tracks', TrackController::class);
        Route::resource('periods', PeriodController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
});


Route::middleware(['auth', 'role:Developer|Owner'])
    ->prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {
        Route::get('hauls', [HaulController::class, 'index'])
            ->name('hauls.index');
        Route::get('hauls/{haul}/edit', [HaulController::class, 'edit'])
            ->name('hauls.edit');
        Route::put('hauls/{haul}', [HaulController::class, 'update'])
            ->name('hauls.update');
        Route::patch('hauls/{haul}', [HaulController::class, 'update']);
        Route::delete('hauls/{haul}', [HaulController::class, 'destroy'])
            ->name('hauls.destroy');
        Route::get('hauls/export', [HaulController::class, 'export'])
            ->name('hauls.export');
});

Route::middleware(['auth'])
    ->prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {
        Route::get('hauls/create', [HaulController::class, 'create'])
            ->name('hauls.create');
        Route::post('hauls', [HaulController::class, 'store'])
            ->name('hauls.store');
});

Route::middleware(['auth', 'role:Developer'])
    ->prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {
        Route::get('partners-trash', [PartnerController::class, 'trash'])->name('partners-trash.index');
        Route::post('partners-trash/{id}/restore', [PartnerController::class, 'restore'])->name('partners-trash.restore');
        Route::delete('partners-trash/{id}/force-delete', [PartnerController::class, 'forceDelete'])->name('partners-trash.force-delete');
});

require __DIR__.'/auth.php';
