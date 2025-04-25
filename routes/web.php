<?php

use App\Http\Controllers\GolonganController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin']);
Route::middleware(['auth', 'admin'])->group(function () {
    Route::controller(MahasiswaController::class)->prefix('admin/dashboard/mahasiswa')->group(function () {
        Route::get('', 'index')->name('mahasiswa');
        Route::post('/store', 'store')->name('mahasiswa-store');
        Route::patch('/update/{id}', 'update')->name('mahasiswa-update');
        Route::delete('/destroy/{id}', 'destroy')->name('mahasiswa-destroy');
    });

    Route::controller(GolonganController::class)->prefix('admin/dashboard/golongan')->group(function () {
        Route::get('', 'index')->name('golongan');
        Route::post('/store', 'store')->name('golongan-store');
        Route::patch('/update/{id}', 'update')->name('golongan-update');
        Route::delete('/destroy/{id}', 'destroy')->name('golongan-destroy');
    });
});


Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
