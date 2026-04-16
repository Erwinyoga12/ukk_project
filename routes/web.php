<?php

use Illuminate\Support\Facades\Route;

// ================= CONTROLLER =================
use App\Http\Controllers\AdControlller;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ControllerAuth;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\AuthKesiswaanController;


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

Route::get('/product',   [ProductController::class,  'pro'])->name('product.pro');
Route::post('/product',  [ProductController::class,  'store'])->name('product.store');


/* ============================================================
   ROUTE AUTH / LOGIN LAMA (Pembina)
============================================================ */
Route::get('/gin',  fn() => view('gin'))->name('gin');
Route::post('/gin', [ControllerAuth::class, 'login'])->name('gin.login');
Route::post('/cek_user', [ControllerAuth::class, 'login'])->name('login.process');


/* ============================================================
   ROUTE PENILAIAN ESKUL
============================================================ */
Route::get('/eskul',         [PenilaianController::class, 'index']);
Route::get('/eskul/data',    [PenilaianController::class, 'data']);
Route::post('/eskul/simpan', [PenilaianController::class, 'simpan']);

Route::get('/rekap', [RekapController::class, 'index']);


/* ============================================================
   LOGOUT ESKUL (custom session)
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
Route::get('/contak', [KegiatanController::class, 'contak']);


/* ============================================================
   ROUTE KESISWAAN
============================================================ */
Route::prefix('kesiswaan')->name('kesiswaan.')->group(function () {

    // Guest only — kalau sudah login redirect ke dashboard
    Route::middleware('guest:kesiswaan')->group(function () {
        Route::get('/login',  [AuthKesiswaanController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthKesiswaanController::class, 'login'])->name('login.process');
    });

    // Auth only — kalau belum login redirect ke /kesiswaan/login
    Route::middleware('auth:kesiswaan')->group(function () {
        Route::post('/logout',   [AuthKesiswaanController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [AuthKesiswaanController::class, 'dashboard'])->name('dashboard');
    });
});

