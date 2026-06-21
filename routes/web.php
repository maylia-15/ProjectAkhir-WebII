<?php

use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\WargaController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ReportController as UserReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Project BiSa (Backend: Manda)
|--------------------------------------------------------------------------
| Dikelompokkan per middleware:
| 1. guest   -> belum login (login, register)
| 2. auth    -> sudah login, dipakai bersama (profil, logout)
| 3. auth + role:admin  -> khusus Admin
| 4. auth + role:warga  -> khusus Warga
*/

// Redirect halaman utama langsung ke login
Route::redirect('/', '/login');

/*
|--------------------------------------------------------------------------
| 1. Guest Routes (belum login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');
});

/*
|--------------------------------------------------------------------------
| 2. Auth Routes (sudah login, dipakai Admin maupun Warga)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| 3. Admin Routes (khusus role: admin)
|--------------------------------------------------------------------------
*/
// Matikan sementara ['auth', 'role:admin'] agar tidak stuck
Route::middleware([]) 
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Data Laporan Warga
        Route::get('/laporan', [AdminReportController::class, 'index'])->name('reports.index');
        Route::get('/laporan/{report}', [AdminReportController::class, 'show'])->name('reports.show');
        Route::patch('/laporan/{report}/status', [AdminReportController::class, 'updateStatus'])->name('reports.updateStatus');
        Route::delete('/laporan/{report}', [AdminReportController::class, 'destroy'])->name('reports.destroy');

        // Kelola Pengumuman
        Route::get('/pengumuman', [AdminAnnouncementController::class, 'index'])->name('announcements.index');
        Route::post('/pengumuman', [AdminAnnouncementController::class, 'store'])->name('announcements.store');
        Route::put('/pengumuman/{announcement}', [AdminAnnouncementController::class, 'update'])->name('announcements.update');
        Route::delete('/pengumuman/{announcement}', [AdminAnnouncementController::class, 'destroy'])->name('announcements.destroy');

        // Data Warga
        Route::get('/warga', [WargaController::class, 'index'])->name('wargas.index');
    });

/*
|--------------------------------------------------------------------------
| 4. User/Warga Routes (khusus role: warga)
|--------------------------------------------------------------------------
| Catatan: TIDAK ADA route Pengumuman terpisah di sini -> Pengumuman hanya
| muncul sebagai Card di Dashboard (lihat UserDashboardController@index).
*/
// Matikan sementara ['auth', 'role:warga'] agar tidak stuck
Route::middleware([]) 
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

        // Laporan Saya + Buat Laporan
        Route::get('/laporan', [UserReportController::class, 'index'])->name('reports.index');
        Route::get('/laporan/buat', [UserReportController::class, 'create'])->name('reports.create');
        Route::post('/laporan', [UserReportController::class, 'store'])->name('reports.store');
        Route::get('/laporan/{report}', [UserReportController::class, 'show'])->name('reports.show');
        Route::get('/laporan/{report}/edit', [UserReportController::class, 'edit'])->name('reports.edit');
        Route::put('/laporan/{report}', [UserReportController::class, 'update'])->name('reports.update');
        Route::delete('/laporan/{report}', [UserReportController::class, 'destroy'])->name('reports.destroy');
    });