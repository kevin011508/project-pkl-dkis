<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\ManajemenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\Manajemen\UserGroupsController;


/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login')
    ->middleware('guest');

Route::post('/', [AuthController::class, 'login'])
    ->name('login.post')
    ->middleware('guest');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| ROUTE YANG BUTUH LOGIN
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD ADMIN
    |--------------------------------------------------------------------------
    */
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | MANAJEMEN SUPERADMIN
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:superadmin'])->prefix('manajemen')->name('manajemen.')->group(function () {
        Route::get('/', [ManajemenController::class, 'index'])->name('dashboard');
        Route::get('/user', [ManajemenController::class, 'user'])->name('user');
        Route::get('/organisasi', [ManajemenController::class, 'organisasi'])->name('organisasi');
        Route::get('/pengaturan', [ManajemenController::class, 'pengaturan'])->name('pengaturan');
    });

    /*
    |--------------------------------------------------------------------------
    | AGENDA
    |--------------------------------------------------------------------------
    */
    Route::resource('agenda', AgendaController::class);

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


Route::resource('user-groups', UserGroupController::class);





Route::prefix('manajemen')->group(function () {
    Route::resource('user-groups', UserGroupsController::class);
});