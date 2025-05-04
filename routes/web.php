<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

Route::get('/check-status', function () {
    return ['done' => Cache::pull('import_done_' . auth()->id()) ?? false];
});



// Halaman Awal
Route::get('/', function () {
    return view('welcome');
});

// =======================
// User Dashboard (Role: User)
// =======================
Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [HomeController::class, 'user'])->name('dashboard');
    });
});

// =======================
// Admin Routes (Role: Admin)
// =======================
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::prefix('admin/dashboard')->name('admin.')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');
        Route::post('projects/import', [ProjectController::class, 'import'])->name('projects.import');
        Route::get('projects/export', [ProjectController::class, 'export'])->name('projects.export');
        Route::resource('projects', ProjectController::class);
        Route::resource('members', MemberController::class);
        Route::resource('tasks', TaskController::class);
    });
});

// =======================
// Manager Routes (Role: Manager)
// =======================
Route::middleware(['auth', 'verified', 'manager'])->group(function () {
    Route::prefix('manager/dashboard')->name('manager.')->group(function () {
        Route::get('/', [HomeController::class, 'manager'])->name('dashboard');

    });
});

Route::get('/members/export', [MemberController::class, 'export'])->name('member.excel');
Route::get('/tasks/export', [TaskController::class, 'export'])->name('task.excel');
// =======================
// Profile (Semua Role yang Authenticated)
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
