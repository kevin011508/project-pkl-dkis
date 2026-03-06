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

// ✅ DIPERBAIKI: Ganti dari '/' ke '/login'
Route::post('/login', [AuthController::class, 'login'])
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

    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::view('/profile', 'profile')->name('profile');

    Route::put('/profile/update', [AuthController::class, 'updateProfile'])
        ->name('profile.update');

    /*
    |--------------------------------------------------------------------------
    | AGENDA
    |--------------------------------------------------------------------------
    */
    Route::get('/agenda', [AgendaController::class, 'index'])
        ->name('agenda.index')
        ->middleware('permission:agenda,lihat');

    Route::get('/agenda/create', [AgendaController::class, 'create'])
        ->name('agenda.create')
        ->middleware('permission:agenda,tambah');

    Route::post('/agenda', [AgendaController::class, 'store'])
        ->name('agenda.store')
        ->middleware('permission:agenda,tambah');

    Route::get('/agenda/{id}', [AgendaController::class, 'show'])
        ->name('agenda.show')
        ->middleware('permission:agenda,lihat');

    Route::get('/agenda/{id}/edit', [AgendaController::class, 'edit'])
        ->name('agenda.edit')
        ->middleware('permission:agenda,edit');

    Route::put('/agenda/{id}', [AgendaController::class, 'update'])
        ->name('agenda.update')
        ->middleware('permission:agenda,edit');

    Route::delete('/agenda/{id}', [AgendaController::class, 'destroy'])
        ->name('agenda.destroy')
        ->middleware('permission:agenda,hapus');

    Route::get('/agenda-trash', [AgendaController::class, 'trash'])
        ->name('agenda.trash')
        ->middleware('permission:agenda,hapus');

    Route::put('/agenda/{id}/restore', [AgendaController::class, 'restore'])
        ->name('agenda.restore')
        ->middleware('permission:agenda,hapus');

    Route::delete('/agenda/{id}/force-delete', [AgendaController::class, 'forceDelete'])
        ->name('agenda.force-delete')
        ->middleware('permission:agenda,hapus');

    Route::delete('/agenda/force-delete-all', [AgendaController::class, 'forceDeleteAll'])
        ->name('agenda.force-delete-all')
        ->middleware('permission:agenda,hapus');

    Route::get('/rekap', [RekapController::class, 'index'])
        ->name('rekap.index')
        ->middleware('permission:agenda,rekap');

    Route::get('/rekap/filter', [RekapController::class, 'filter'])
        ->name('rekap.filter')
        ->middleware('permission:agenda,rekap');

    Route::get('/rekap/export', [RekapController::class, 'exportRekap'])
        ->name('rekap.export')
        ->middleware('permission:agenda,rekap');

    /*
    |--------------------------------------------------------------------------
    | MANAJEMEN
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth'])
        ->prefix('manajemen')
        ->name('manajemen.')
        ->group(function () {

            Route::get('/', [ManajemenController::class, 'index'])
                ->name('dashboard');

            Route::get('/user', [ManajemenController::class, 'user'])
                ->name('user');

            Route::get('/organisasi', [ManajemenController::class, 'organisasi'])
                ->name('organisasi');

            /*
            |--------------------------------------------------------------
            | PENGATURAN
            |--------------------------------------------------------------
            */
            Route::get('/pengaturan', [PengaturanController::class, 'edit'])
                ->name('pengaturan')
                ->middleware('permission:pengaturan,edit');

            Route::put('/pengaturan/update', [PengaturanController::class, 'update'])
                ->name('pengaturan.update')
                ->middleware('permission:pengaturan,edit');

            /*
            |--------------------------------------------------------------
            | USER GROUP
            |--------------------------------------------------------------
            */
            Route::get('/user-groups', [UserGroupController::class, 'index'])
                ->name('user-groups.index')
                ->middleware('permission:user_group,lihat');

            Route::get('/user-groups/create', [UserGroupController::class, 'create'])
                ->name('user-groups.create')
                ->middleware('permission:user_group,tambah');

            Route::post('/user-groups', [UserGroupController::class, 'store'])
                ->name('user-groups.store')
                ->middleware('permission:user_group,tambah');

            Route::get('/user-groups/{id}', [UserGroupController::class, 'show'])
                ->name('user-groups.show')
                ->middleware('permission:user_group,lihat');

            Route::get('/user-groups/{id}/edit', [UserGroupController::class, 'edit'])
                ->name('user-groups.edit')
                ->middleware('permission:user_group,edit');

            Route::put('/user-groups/{id}', [UserGroupController::class, 'update'])
                ->name('user-groups.update')
                ->middleware('permission:user_group,edit');

            Route::delete('/user-groups/{id}', [UserGroupController::class, 'destroy'])
                ->name('user-groups.destroy')
                ->middleware('permission:user_group,hapus');

            /*
            |--------------------------------------------------------------
            | SKPD
            |--------------------------------------------------------------
            */
            Route::get('/skpd', [SkpdController::class, 'index'])
                ->name('skpd.index')
                ->middleware('permission:skpd,lihat');

            Route::get('/skpd/create', [SkpdController::class, 'create'])
                ->name('skpd.create')
                ->middleware('permission:skpd,tambah');

            Route::post('/skpd', [SkpdController::class, 'store'])
                ->name('skpd.store')
                ->middleware('permission:skpd,tambah');

            Route::get('/skpd/{id}/edit', [SkpdController::class, 'edit'])
                ->name('skpd.edit')
                ->middleware('permission:skpd,edit');

            Route::put('/skpd/{id}', [SkpdController::class, 'update'])
                ->name('skpd.update')
                ->middleware('permission:skpd,edit');

            Route::delete('/skpd/{id}', [SkpdController::class, 'destroy'])
                ->name('skpd.destroy')
                ->middleware('permission:skpd,hapus');

            /*
            |--------------------------------------------------------------
            | NON SKPD
            |--------------------------------------------------------------
            */
            Route::get('/non-skpd', [NonSkpdController::class, 'index'])
                ->name('non-skpd.index')
                ->middleware('permission:non_skpd,lihat');

            Route::get('/non-skpd/create', [NonSkpdController::class, 'create'])
                ->name('non-skpd.create')
                ->middleware('permission:non_skpd,tambah');

            Route::post('/non-skpd', [NonSkpdController::class, 'store'])
                ->name('non-skpd.store')
                ->middleware('permission:non_skpd,tambah');

            Route::get('/non-skpd/{id}/edit', [NonSkpdController::class, 'edit'])
                ->name('non-skpd.edit')
                ->middleware('permission:non_skpd,edit');

            Route::put('/non-skpd/{id}', [NonSkpdController::class, 'update'])
                ->name('non-skpd.update')
                ->middleware('permission:non_skpd,edit');

            Route::delete('/non-skpd/{id}', [NonSkpdController::class, 'destroy'])
                ->name('non-skpd.destroy')
                ->middleware('permission:non_skpd,hapus');

            /*
            |--------------------------------------------------------------
            | USER SKPD
            |--------------------------------------------------------------
            */
            Route::get('/user-skpd', [UserSkpdController::class, 'index'])
                ->name('user-skpd.index')
                ->middleware('permission:user_skpd,lihat');

            Route::get('/user-skpd/create', [UserSkpdController::class, 'create'])
                ->name('user-skpd.create')
                ->middleware('permission:user_skpd,tambah');

            Route::post('/user-skpd', [UserSkpdController::class, 'store'])
                ->name('user-skpd.store')
                ->middleware('permission:user_skpd,tambah');

            Route::get('/user-skpd/{id}', [UserSkpdController::class, 'show'])
                ->name('user-skpd.show')
                ->middleware('permission:user_skpd,lihat');

            Route::get('/user-skpd/{id}/edit', [UserSkpdController::class, 'edit'])
                ->name('user-skpd.edit')
                ->middleware('permission:user_skpd,edit');

            Route::put('/user-skpd/{id}', [UserSkpdController::class, 'update'])
                ->name('user-skpd.update')
                ->middleware('permission:user_skpd,edit');

            Route::delete('/user-skpd/{id}', [UserSkpdController::class, 'destroy'])
                ->name('user-skpd.destroy')
                ->middleware('permission:user_skpd,hapus');

            /*
            |--------------------------------------------------------------
            | USER NON SKPD
            |--------------------------------------------------------------
            */
            Route::get('/user-non-skpd', [UserNonSkpdController::class, 'index'])
                ->name('user-non-skpd.index')
                ->middleware('permission:user_non_skpd,lihat');

            Route::get('/user-non-skpd/create', [UserNonSkpdController::class, 'create'])
                ->name('user-non-skpd.create')
                ->middleware('permission:user_non_skpd,tambah');

            Route::post('/user-non-skpd', [UserNonSkpdController::class, 'store'])
                ->name('user-non-skpd.store')
                ->middleware('permission:user_non_skpd,tambah');

            Route::get('/user-non-skpd/{id}', [UserNonSkpdController::class, 'show'])
                ->name('user-non-skpd.show')
                ->middleware('permission:user_non_skpd,lihat');

            Route::get('/user-non-skpd/{id}/edit', [UserNonSkpdController::class, 'edit'])
                ->name('user-non-skpd.edit')
                ->middleware('permission:user_non_skpd,edit');

            Route::put('/user-non-skpd/{id}', [UserNonSkpdController::class, 'update'])
                ->name('user-non-skpd.update')
                ->middleware('permission:user_non_skpd,edit');

            Route::delete('/user-non-skpd/{id}', [UserNonSkpdController::class, 'destroy'])
                ->name('user-non-skpd.destroy')
                ->middleware('permission:user_non_skpd,hapus');

            /*
            |--------------------------------------------------------------
            | USER PERMISSION
            |--------------------------------------------------------------
            */
            Route::get('/user-permission/data', [UserPermissionController::class, 'getData'])
                ->name('user-permission.data');

            Route::get('/user-permission', [UserPermissionController::class, 'index'])
                ->name('user-permission.index')
                ->middleware('permission:user_permission,lihat');

            Route::get('/user-permission/create', [UserPermissionController::class, 'create'])
                ->name('user-permission.create')
                ->middleware('permission:user_permission,tambah');

            Route::post('/user-permission', [UserPermissionController::class, 'store'])
                ->name('user-permission.store')
                ->middleware('permission:user_permission,tambah');

            Route::get('/user-permission/{id}/edit', [UserPermissionController::class, 'edit'])
                ->name('user-permission.edit')
                ->middleware('permission:user_permission,edit');

            Route::put('/user-permission/{id}', [UserPermissionController::class, 'update'])
                ->name('user-permission.update')
                ->middleware('permission:user_permission,edit');

            Route::delete('/user-permission/{id}', [UserPermissionController::class, 'destroy'])
                ->name('user-permission.destroy')
                ->middleware('permission:user_permission,hapus');

        });
});

/*
|--------------------------------------------------------------------------
| DISPLAY
|--------------------------------------------------------------------------
*/
Route::get('/display', [DisplayController::class, 'index'])
    ->name('display');

    Route::get('/test-auth', function() {
    return response()->json([
        'auth' => auth()->check(),
        'user' => auth()->user(),
        'session' => session()->all(),
    ]);
})->middleware('auth');