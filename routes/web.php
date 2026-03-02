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
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\PengaturanController;

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
    | AGENDA
    |--------------------------------------------------------------------------
    */
    Route::get('/agenda-trash', [AgendaController::class, 'trash'])
        ->name('agenda.trash');

    Route::put('/agenda/{id}/restore', [AgendaController::class, 'restore'])
        ->name('agenda.restore');

    Route::delete('/agenda/{id}/force-delete', [AgendaController::class, 'forceDelete'])
        ->name('agenda.force-delete');

    Route::delete('/agenda/force-delete-all', [AgendaController::class, 'forceDeleteAll'])
        ->name('agenda.force-delete-all');

    Route::resource('agenda', AgendaController::class);

    /*
    |--------------------------------------------------------------------------
    | REKAP
    |--------------------------------------------------------------------------
    */
    Route::get('/rekap', [RekapController::class, 'index'])
        ->name('rekap.index');

    // ✅ Ubah POST → GET
    Route::get('/rekap/filter', [RekapController::class, 'filter'])
        ->name('rekap.filter');

    Route::get('/rekap/export', [RekapController::class, 'exportRekap'])
        ->name('rekap.export');

    /*
    |--------------------------------------------------------------------------
    | MANAJEMEN SUPERADMIN
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:superadmin'])->prefix('manajemen')->name('manajemen.')->group(function () {
        Route::get('/', [ManajemenController::class, 'index'])->name('dashboard');
        Route::get('/user', [ManajemenController::class, 'user'])->name('user');
        Route::get('/organisasi', [ManajemenController::class, 'organisasi'])->name('organisasi');

        // Pengaturan
        Route::get('/pengaturan',        [PengaturanController::class, 'edit'])   ->name('pengaturan');
        Route::put('/pengaturan/update', [PengaturanController::class, 'update']) ->name('pengaturan.update');

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

/*
|--------------------------------------------------------------------------
| DISPLAY
|--------------------------------------------------------------------------
*/
Route::get('/display', [DisplayController::class, 'index'])->name('display');