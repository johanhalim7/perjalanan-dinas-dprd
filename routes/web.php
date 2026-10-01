<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PerjalananDinasController;
use App\Http\Controllers\DetailPerjalananDinasController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ROUTE UMUM
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| PERJALANAN DINAS
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */
    Route::get('/perjalanan-dinas',
        [PerjalananDinasController::class, 'index'])
        ->name('perjalanan-dinas.index');

    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY (HARUS DI ATAS ROUTE {id})
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {

        Route::get('/perjalanan-dinas/create',
            [PerjalananDinasController::class, 'create'])
            ->name('perjalanan-dinas.create');

        Route::post('/perjalanan-dinas',
            [PerjalananDinasController::class, 'store'])
            ->name('perjalanan-dinas.store');

        Route::get('/perjalanan-dinas/export/pdf',
            [PerjalananDinasController::class, 'exportPdf'])
            ->name('perjalanan-dinas.export.pdf');

        Route::get('/perjalanan-dinas/preview-pdf',
            [PerjalananDinasController::class, 'previewPdf'])
            ->name('perjalanan-dinas.preview.pdf');

        Route::get('/perjalanan-dinas/{id}/edit',
            [PerjalananDinasController::class, 'edit'])
            ->name('perjalanan-dinas.edit');

        Route::put('/perjalanan-dinas/{id}',
            [PerjalananDinasController::class, 'update'])
            ->name('perjalanan-dinas.update');

        Route::delete('/perjalanan-dinas/{id}',
            [PerjalananDinasController::class, 'destroy'])
            ->name('perjalanan-dinas.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | SURAT TUGAS (ADMIN & PEGAWAI MILIK SENDIRI)
    |--------------------------------------------------------------------------
    */
    Route::get('/perjalanan-dinas/{id}/surat-tugas/preview',
        [PerjalananDinasController::class, 'previewSuratTugas'])
        ->name('perjalanan-dinas.preview-surat-tugas');

    Route::get('/perjalanan-dinas/{id}/surat-tugas/download',
        [PerjalananDinasController::class, 'downloadSuratTugas'])
        ->name('perjalanan-dinas.download-surat-tugas');

    /*
    |--------------------------------------------------------------------------
    | DETAIL PERJALANAN DINAS
    |--------------------------------------------------------------------------
    */
    Route::post('/detail-perjalanan-dinas',
        [DetailPerjalananDinasController::class, 'store'])
        ->name('detail-perjalanan-dinas.store');

    Route::get('/detail-perjalanan-dinas/{id}/laporan/preview',
        [DetailPerjalananDinasController::class, 'previewLaporan'])
        ->name('detail-perjalanan-dinas.preview-laporan');

    /*
    |--------------------------------------------------------------------------
    | UPDATE STATUS DETAIL (ADMIN ONLY)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {
        Route::put('/detail-perjalanan-dinas/{id}/status',
            [DetailPerjalananDinasController::class, 'updateStatus'])
            ->name('detail-perjalanan-dinas.update-status');
        Route::delete('/detail-perjalanan-dinas/{id}',
            [DetailPerjalananDinasController::class, 'destroy'])
            ->name('detail-perjalanan-dinas.destroy');

    });

    /*
    |--------------------------------------------------------------------------
    | SHOW (PALING BAWAH - PENTING)
    |--------------------------------------------------------------------------
    */
    Route::get('/perjalanan-dinas/{id}',
        [PerjalananDinasController::class, 'show'])
        ->name('perjalanan-dinas.show');

    /*
    |--------------------------------------------------------------------------
    | PEGAWAI ONLY (OPSIONAL)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:pegawai')->group(function () {

        Route::put('/perjalanan-dinas/{id}/upload-laporan',
            [PerjalananDinasController::class, 'uploadLaporan'])
            ->name('perjalanan-dinas.upload-laporan');
    });
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
