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
use App\Http\Controllers\RekapController;      // ← tambah ini
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/* ============================================================
   ROUTE LAMA — tidak diubah sama sekali
============================================================ */
Route::get('/kegiatan',[KegiatanController::class, 'keg']);
Route::get('/profil',[ProfilController::class, 'prof']);
Route::get('/index',[KegiatanController::class, 'index']);
Route::get('/prestasi',[KegiatanController::class, 'pres']);
// Route::get('/home',[KegiatanController::class, 'home']);
Route::get('/gin',[KegiatanController::class, 'gin']);
Route::get('/prmkrekap',[KegiatanController::class, 'rkpPramuka']);
Route::get('/gotapramu',[KegiatanController::class, 'gotapramuka']);
Route::get('/contak',[KegiatanController::class, 'contak']);
Route::get('/contact',[ContactController::class, 'con'])->name('contact.index');
Route::get('/users',[UserController::class, 'tambahdata']);
Route::post('contact',[ContactController::class, 'store'])->name('contact.store');
Route::post('cek_user',[ControllerAuth::class, 'cek_akun'])->name('cek_user');
Route::get('/dashboard',[AdControlller::class, 'dash'])->name('dashboard');
Route::get('/customer',[CustomerController::class, 'cus'])->name('customer.cus');
Route::post('/customer',[CustomerController::class, 'store'])->name('customer.store');
Route::get('/product',[ProductController::class, 'pro'])->name('product.pro');
Route::post('/product',[ProductController::class, 'store'])->name('product.store');

Route::get('/login', function(){ return view('login'); });

Route::get('/eskul', [PenilaianController::class, 'index']);
Route::get('/eskul/data',[PenilaianController::class,'data']);
Route::post('/eskul/simpan',[PenilaianController::class,'simpan']);

/* ============================================================
   ROUTE BARU — untuk sistem rekap
   Tambahkan 3 route ini saja
============================================================ */

// Dipanggil fetch() dari gin.blade.php saat login berhasil
// Tugasnya: simpan eskul ke session Laravel
Route::post('/set-session', function(Request $request){
    session(['eskul_login' => $request->eskul]);
    return response()->json(['status' => 'ok']);
});

// Halaman rekap — baca data dari DB sesuai eskul yang login
Route::get('/rekap', [RekapController::class, 'index']);

// Dipanggil saat logout dari halaman rekap
Route::post('/logout-eskul', function(){
    $eskul = session('eskul_login');

    $models = [
        'pramuka'      => \App\Models\RekapPramuka::class,
        'paskibra'     => \App\Models\RekapPaskibra::class,
        'natbinari'    => \App\Models\RekapNatbinari::class,
        'jurnal'       => \App\Models\RekapJurnal::class,
        'marchingband' => \App\Models\RekapMarchingband::class,
        'pmr'          => \App\Models\RekapPmr::class,
    ];

    // ✅ Hapus semua data rekap saat logout
    $model = $models[$eskul] ?? null;
    if ($model) {
        $model::query()->delete();
    }

    session()->forget('eskul_login');
    session()->forget('sudah_nilai');

    return response()->json(['status' => 'ok']);
});
Route::get('/',[KegiatanController::class, 'home']);
