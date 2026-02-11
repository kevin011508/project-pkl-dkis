<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\ManajemenController;

/*
|--------------------------------------------------------------------------
| MANAJEMEN
|--------------------------------------------------------------------------
*/
Route::prefix('manajemen')->name('manajemen.')->group(function () {

    // Dashboard Manajemen
    Route::get('/', [ManajemenController::class, 'index'])
        ->name('dashboard');

    // User
    Route::get('/user', [ManajemenController::class, 'user'])
        ->name('user');

    // Organisasi
    Route::get('/organisasi', [ManajemenController::class, 'organisasi'])
        ->name('organisasi');

    // Pengaturan
    Route::get('/pengaturan', [ManajemenController::class, 'pengaturan'])
        ->name('pengaturan');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| AGENDA
|--------------------------------------------------------------------------
*/
Route::resource('agenda', AgendaController::class);

/* tambahan agenda (di luar resource) */
Route::get('/agenda-trash', [AgendaController::class, 'trash'])
    ->name('agenda.trash');

Route::put('/agenda/{id}/restore', [AgendaController::class, 'restore'])
    ->name('agenda.restore');

Route::get('/agenda/export/rekap', [AgendaController::class, 'exportRekap'])
    ->name('agenda.export-rekap');

/*
|--------------------------------------------------------------------------
| REKAP
|--------------------------------------------------------------------------
*/
Route::get('/rekap', [RekapController::class, 'index'])
    ->name('rekap.index');

Route::post('/rekap/filter', [RekapController::class, 'filter'])
    ->name('rekap.filter');

/*
|--------------------------------------------------------------------------
| HALAMAN LAIN
|--------------------------------------------------------------------------
*/
Route::view('/login', 'login')->name('login');
Route::view('/profile', 'profile')->name('profile');
