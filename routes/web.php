<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrganizationController;

// Dashboard dan Authentication
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Agenda Routes
Route::prefix('agenda')->name('agenda.')->group(function () {
    Route::get('/', [AgendaController::class, 'index'])->name('index');
    Route::get('/create', [AgendaController::class, 'create'])->name('create');
    Route::post('/', [AgendaController::class, 'store'])->name('store');
    Route::get('/{agenda}', [AgendaController::class, 'show'])->name('show');
    Route::get('/{agenda}/edit', [AgendaController::class, 'edit'])->name('edit');
    Route::put('/{agenda}', [AgendaController::class, 'update'])->name('update');
    Route::delete('/{agenda}', [AgendaController::class, 'destroy'])->name('destroy');
});

// Management Routes
Route::prefix('management')->name('management.')->group(function () {
    Route::get('/', [ManagementController::class, 'index'])->name('index');
    // Tambahan route untuk manajemen lainnya
});

// Resource Routes
Route::resource('users', UserController::class);
Route::resource('organizations', OrganizationController::class);

// Settings
Route::get('/settings', function () {
    return view('settings.index');
})->name('settings');

// Display Mode
Route::get('/display', function () {
    return view('display.index');
})->name('display');

// ROUTE AGENDA
Route::prefix('agenda')->name('agenda.')->group(function () {
    // INDEX - Daftar Agenda
    Route::get('/', [AgendaController::class, 'index'])->name('index');
    
    // CREATE - Form Tambah
    Route::get('/create', [AgendaController::class, 'create'])->name('create');
    
    // STORE - Simpan Data
    Route::post('/', [AgendaController::class, 'store'])->name('store');
    
    // SHOW - Detail Agenda
    Route::get('/{id}', [AgendaController::class, 'show'])->name('show');
    
    // EDIT - Form Edit
    Route::get('/{id}/edit', [AgendaController::class, 'edit'])->name('edit');
    
    // UPDATE - Update Data
    Route::put('/{id}', [AgendaController::class, 'update'])->name('update');
    
    // DELETE - Hapus Data
    Route::delete('/{id}', [AgendaController::class, 'destroy'])->name('destroy');

    // ===== TAMBAHKAN INI =====
    // EXPORT REKAP - Export Data
    Route::get('/export/rekap', [AgendaController::class, 'exportRekap'])->name('export-rekap');
    // ========================
    });
    
        // RESTORE - Kembalikan Data Terhapus
        Route::put('/agenda/{id}/restore', [AgendaController::class, 'restore'])
        ->name('agenda.restore');


    // TRASH - Daftar Data Terhapus
    Route::get('/agenda-trash', [AgendaController::class, 'trash'])
    ->name('agenda.trash');
    Route::resource('agenda', AgendaController::class);


    

Route::get('/dashboard', function () {
    return view('agenda');
})->name('dashboard');



Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/rekap', [RekapController::class, 'index'])->name('rekap.index');
Route::post('/rekap', [RekapController::class, 'filter'])->name('rekap.filter');
Route::post('/rekap', [AgendaController::class, 'rekap'])
    ->name('rekap');

// ROUTE LAINNYA
Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/login', function () {
    return view('login');
});

Route::get('/profile', function () {
    return view('profile');
});

