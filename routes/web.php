<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\ManajemenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\UserSkpdController;
use App\Http\Controllers\UserNonSkpdController;
use App\Http\Controllers\UserPermissionController;
use App\Http\Controllers\SkpdController;
use App\Http\Controllers\NonSkpdController;

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
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */
    Route::view('/profile', 'profile')->name('profile');
    Route::put('/profile/update', [AuthController::class, 'updateProfile'])
        ->name('profile.update');

    /*
    |--------------------------------------------------------------------------
    | AGENDA - custom routes HARUS di atas resource
    |--------------------------------------------------------------------------
    */
    Route::get('/agenda-trash', [AgendaController::class, 'trash'])
        ->name('agenda.trash');

    Route::put('/agenda/{id}/restore', [AgendaController::class, 'restore'])
        ->name('agenda.restore');

    Route::get('/agenda/export/rekap', [AgendaController::class, 'exportRekap'])
        ->name('agenda.export-rekap');

    Route::resource('agenda', AgendaController::class);

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
    | MANAJEMEN SUPERADMIN
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:superadmin'])->prefix('manajemen')->name('manajemen.')->group(function () {
        Route::get('/', [ManajemenController::class, 'index'])->name('dashboard');
        Route::get('/user', [ManajemenController::class, 'user'])->name('user');
        Route::get('/organisasi', [ManajemenController::class, 'organisasi'])->name('organisasi');
        Route::get('/pengaturan', [ManajemenController::class, 'pengaturan'])->name('pengaturan');

        Route::resource('user-groups', UserGroupController::class);
        Route::resource('skpd', SkpdController::class);
        Route::resource('non-skpd', NonSkpdController::class);
        Route::resource('user-skpd', UserSkpdController::class);
        Route::resource('user-non-skpd', UserNonSkpdController::class);
        Route::resource('user-permission', UserPermissionController::class);
        Route::post('/user-permission/toggle/{id}', [UserPermissionController::class, 'toggleStatus'])
            ->name('user-permission.toggle');
    });
});