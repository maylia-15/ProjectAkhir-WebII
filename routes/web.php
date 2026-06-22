<?php

use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\WargaController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ReportController as UserReportController;
use Illuminate\Support\Facades\Route;



// Landing Page (Akses Publik) - sesuai konsep UI revisi final
Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');
});


Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Profil dipecah: halaman lihat (show) terpisah dari form edit (edit)
    Route::get('/profil', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profil/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');
});


Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Data Laporan Warga
        Route::get('/laporan', [AdminReportController::class, 'index'])->name('reports.index');
        Route::get('/laporan/{report}', [AdminReportController::class, 'show'])->name('reports.show');
        Route::patch('/laporan/{report}/status', [AdminReportController::class, 'updateStatus'])->name('reports.updateStatus');
        Route::delete('/laporan/{report}', [AdminReportController::class, 'destroy'])->name('reports.destroy');

        // Kelola Pengumuman (CRUD via Modal)
        Route::get('/pengumuman', [AdminAnnouncementController::class, 'index'])->name('announcements.index');
        Route::post('/pengumuman', [AdminAnnouncementController::class, 'store'])->name('announcements.store');
        Route::put('/pengumuman/{announcement}', [AdminAnnouncementController::class, 'update'])->name('announcements.update');
        Route::delete('/pengumuman/{announcement}', [AdminAnnouncementController::class, 'destroy'])->name('announcements.destroy');

        // Data Warga (Read Only)
        Route::get('/warga', [WargaController::class, 'index'])->name('wargas.index');
    });


Route::middleware(['auth', 'role:warga'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

        // Laporan Saya + Buat Laporan (Resource lengkap kecuali method index dipisah biar urutan path rapi)
        Route::get('/laporan', [UserReportController::class, 'index'])->name('reports.index');
        Route::get('/laporan/buat', [UserReportController::class, 'create'])->name('reports.create');
        Route::post('/laporan', [UserReportController::class, 'store'])->name('reports.store');
        Route::get('/laporan/{report}', [UserReportController::class, 'show'])->name('reports.show');
        Route::get('/laporan/{report}/edit', [UserReportController::class, 'edit'])->name('reports.edit');
        Route::put('/laporan/{report}', [UserReportController::class, 'update'])->name('reports.update');
        Route::delete('/laporan/{report}', [UserReportController::class, 'destroy'])->name('reports.destroy');
    });

/*
|--------------------------------------------------------------------------
| 🧪 TEMPORARY PREVIEW ROUTES (Rute Sementara untuk Cek UI Naufal)
|--------------------------------------------------------------------------
| Hapus atau komentari seluruh blok ini jika proyek sudah siap dikumpul/UAS!
*/
Route::prefix('preview')->group(function () {

    // Helper otomatis untuk login tiruan Warga (Biar layout.user tidak null)
    $loginWargaDummy = function () {
        $user = new \App\Models\User([
            'name' => 'Ahmad Wijaya',
            'blok_rumah' => 'A-101',
            'no_hp' => '08123456789',
            'email' => 'warga.dummy@bi.sa',
            'role' => 'warga'
        ]);
        \Illuminate\Support\Facades\Auth::login($user);
        return $user;
    };

    // Helper otomatis untuk login tiruan Admin (Biar layout.admin tidak null)
    $loginAdminDummy = function () {
        $user = new \App\Models\User([
            'name' => 'Pak RT Ahmad',
            'blok_rumah' => 'Kantor RT',
            'no_hp' => '08987654321',
            'email' => 'admin.dummy@bi.sa',
            'role' => 'admin'
        ]);
        \Illuminate\Support\Facades\Auth::login($user);
        return $user;
    };

    // Helper otomatis untuk merakit Data Laporan Tiruan Lengkap beserta Relasinya
    $makeReportDummy = function () {
        $report = new \App\Models\Report();
        
        // REVISI: Menggunakan forceFill agar created_at tidak di-block oleh $fillable
        $report->forceFill([
            'id' => 1,
            'judul' => 'Sampah Menumpuk di Pertigaan Blok A',
            'deskripsi' => 'Sampah kantong plastik dan sisa makanan menumpuk hingga memakan bahu jalan dan menimbulkan bau menyengat.',
            'lokasi' => 'Depan lapangan dekat pertigaan Blok A',
            'status' => 'menunggu',
            'created_at' => now(),
        ]);
        
        // Suntik relasi agar tidak memicu error "property on null"
        $report->setRelation('user', new \App\Models\User(['name' => 'Ahmad Wijaya', 'blok_rumah' => 'A-101']));
        $report->setRelation('category', new \App\Models\Category(['nama_kategori' => 'Anorganik']));
        $report->setRelation('tags', collect([
            new \App\Models\Tag(['nama_tag' => 'Menumpuk']),
            new \App\Models\Tag(['nama_tag' => 'Bau Menyengat'])
        ]));
        
        return $report;
    };

    // 1. Landing Page & Autentikasi
    Route::get('/landing', function () {
        return view('landing', ['totalLaporanSelesai' => 142]);
    });
    Route::view('/login', 'auth.login');
    Route::view('/register', 'auth.register');

    // 2. Halaman Profil
    Route::get('/profil', function () use ($loginWargaDummy) {
        $user = $loginWargaDummy();
        return view('profile.show', ['user' => $user]);
    });
    Route::get('/profil/edit', function () use ($loginWargaDummy) {
        $user = $loginWargaDummy();
        return view('profile.edit', ['user' => $user]);
    });

    // 3. Tampilan Halaman USER / WARGA
    Route::get('/user/dashboard', function () use ($loginWargaDummy) {
        $loginWargaDummy();
        return view('user.dashboard.index', [
            'pengumumanBanner' => null, 
            'ringkasan' => ['total' => 4, 'menunggu' => 1, 'diproses' => 1, 'selesai' => 2],
            'laporanTerbaru' => collect(),
            'pengumumanTerbaru' => collect()
        ]);
    });
    
    Route::get('/user/laporan', function () use ($loginWargaDummy) {
        $loginWargaDummy();
        $paginatorDummy = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10, 1, [
            'path' => request()->url()
        ]);
        return view('user.reports.index', ['reports' => $paginatorDummy]);
    });
    
    Route::get('/user/laporan/buat', function () use ($loginWargaDummy) {
        $loginWargaDummy();
        $categoriesDummy = collect([
            new \App\Models\Category(['id' => 1, 'nama_kategori' => 'Organik']),
            new \App\Models\Category(['id' => 2, 'nama_kategori' => 'Anorganik']),
            new \App\Models\Category(['id' => 3, 'nama_kategori' => 'B3 (Berbahaya)']),
        ]);
        $tagsDummy = collect([
            new \App\Models\Tag(['id' => 1, 'nama_tag' => 'Bau Menyengat']),
            new \App\Models\Tag(['id' => 2, 'nama_tag' => 'Menumpuk']),
            new \App\Models\Tag(['id' => 3, 'nama_tag' => 'Berserakan']),
        ]);
        return view('user.reports.create', ['categories' => $categoriesDummy, 'tags' => $tagsDummy]);
    });

    Route::get('/user/laporan/detail', function () use ($loginWargaDummy, $makeReportDummy) {
        $loginWargaDummy();
        return view('user.reports.show', ['report' => $makeReportDummy()]);
    });

    Route::get('/user/laporan/edit', function () use ($loginWargaDummy, $makeReportDummy) {
        $loginWargaDummy();
        $categoriesDummy = collect([
            new \App\Models\Category(['id' => 1, 'nama_kategori' => 'Organik']),
            new \App\Models\Category(['id' => 2, 'nama_kategori' => 'Anorganik']),
        ]);
        $tagsDummy = collect([
            new \App\Models\Tag(['id' => 1, 'nama_tag' => 'Bau Menyengat']),
            new \App\Models\Tag(['id' => 2, 'nama_tag' => 'Menumpuk']),
        ]);
        return view('user.reports.edit', [
            'report' => $makeReportDummy(),
            'categories' => $categoriesDummy,
            'tags' => $tagsDummy
        ]);
    });

    // 4. Tampilan Halaman ADMIN
    Route::get('/admin/dashboard', function () use ($loginAdminDummy) {
        $loginAdminDummy();
        return view('admin.dashboard.index', [
            'ringkasan' => ['total' => 12, 'menunggu' => 3, 'diproses' => 4, 'selesai' => 5]
        ]);
    });
    
    Route::get('/admin/laporan', function () use ($loginAdminDummy) {
        $loginAdminDummy();
        $paginatorDummy = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10, 1, [
            'path' => request()->url()
        ]);
        return view('admin.reports.index', ['reports' => $paginatorDummy]);
    });
    
    Route::get('/admin/laporan/detail', function () use ($loginAdminDummy, $makeReportDummy) {
        $loginAdminDummy();
        return view('admin.reports.show', ['report' => $makeReportDummy()]);
    });

    Route::get('/admin/pengumuman', function () use ($loginAdminDummy) {
        $loginAdminDummy();
        return view('admin.announcements.index', ['announcements' => collect()]);
    });
    Route::get('/admin/warga', function () use ($loginAdminDummy) {
        $loginAdminDummy();
        return view('admin.wargas.index', ['wargas' => collect()]);
    });
});