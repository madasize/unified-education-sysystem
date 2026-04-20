<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    Route::view('gradebook', 'gradebook')
    ->middleware(['auth', 'verified'])
    ->name('gradebook');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
    Route::view('reports', 'reports')->middleware(['auth'])->name('reports');
Route::view('enrollment', 'enrollment')->middleware(['auth'])->name('enrollment');
require __DIR__.'/auth.php';
