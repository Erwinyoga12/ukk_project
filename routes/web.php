<?php
use App\Http\Controllers\AdControlller;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ControllerAuth;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\RekapController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/* ============================================================
   ROUTE LAMA — tidak diubah
============================================================ */
Route::get('/kegiatan',  [KegiatanController::class, 'keg']);
Route::get('/profil',    [ProfilController::class,   'prof']);
Route::get('/index',     [KegiatanController::class, 'index']);
Route::get('/prestasi',  [KegiatanController::class, 'pres']);
Route::get('/prmkrekap', [KegiatanController::class, 'rkpPramuka']);
Route::get('/gotapramu', [KegiatanController::class, 'gotapramuka']);
Route::get('/contact',   [ContactController::class,  'con'])->name('contact.index');
Route::post('/contact',  [ContactController::class,  'store'])->name('contact.store');
Route::get('/users',     [UserController::class,     'tambahdata']);
Route::get('/dashboard', [AdControlller::class,      'dash'])->name('dashboard');
Route::get('/customer',  [CustomerController::class, 'cus'])->name('customer.cus');
Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');
Route::get('/product',   [ProductController::class,  'pro'])->name('product.pro');
Route::post('/product',  [ProductController::class,  'store'])->name('product.store');

/* ============================================================
   ROUTE AUTH / LOGIN
   - Hanya satu GET /gin (sebelumnya ada dua → conflict)
   - POST /gin untuk proses login
============================================================ */
Route::get('/gin',  fn() => view('gin'))->name('gin');
Route::post('/gin', [ControllerAuth::class, 'login'])->name('gin.login');

// Route lama — dipertahankan agar tidak breaking
Route::post('/cek_user', [ControllerAuth::class, 'login'])->name('login.process');

/* ============================================================
   ROUTE PENILAIAN ESKUL
   ✅ Tidak pakai middleware('auth') karena sistem ini
      memakai custom session, bukan Laravel Auth.
      Proteksi session sudah ada di PenilaianController.
============================================================ */
Route::get('/eskul',         [PenilaianController::class, 'index']);
Route::get('/eskul/data',    [PenilaianController::class, 'data']);
Route::post('/eskul/simpan', [PenilaianController::class, 'simpan']);
Route::get('/rekap', [RekapController::class, 'index']);

/* ============================================================
   LOGOUT ESKUL
   ✅ Hapus semua session login
============================================================ */
Route::post('/logout-eskul', function () {
    session()->forget('eskul_login');
    session()->forget('sudah_nilai');
    return response()->json(['success' => true]);
});

/* ============================================================
   HOME
============================================================ */
Route::get('/', [KegiatanController::class, 'home']);

Route::get('/contak',    [KegiatanController::class, 'contak']);
