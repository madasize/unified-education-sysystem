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

// Teacher Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('resource-hub', 'teacher.resource-hub')->name('resource-hub');
    Route::view('innovation', 'teacher.innovation')->name('innovation');
});

// Headteacher Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('grade-approval', 'headteacher.grade-approval')->name('grade-approval');
    Route::view('user-management', 'headteacher.user-management')->name('user-management');
});

// Cluster Head Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('cluster-overview', 'cluster.cluster-overview')->name('cluster-overview');
    Route::view('inspection', 'cluster.inspection')->name('inspection');
    Route::view('resource-allocation', 'cluster.resource-allocation')->name('resource-allocation');
});

// Ministry Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('national-analytics', 'ministry.national-analytics')->name('national-analytics');
    Route::view('policy-control', 'ministry.policy-control')->name('policy-control');
    Route::view('funding', 'ministry.funding')->name('funding');
    Route::view('teacher-recommendations', 'ministry.teacher-recommendations')->name('teacher-recommendations');
    Route::view('educational-updates', 'ministry.educational-updates')->name('educational-updates');
});

require __DIR__.'/auth.php';
