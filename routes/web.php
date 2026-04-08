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
Route::get('/dashboard',[AdControlller::class, 'dash'])->name('dashboard');
Route::get('/customer',[CustomerController::class, 'cus'])->name('customer.cus');
Route::post('/customer',[CustomerController::class, 'store'])->name('customer.store');
Route::get('/product',[ProductController::class, 'pro'])->name('product.pro');
Route::post('/product',[ProductController::class, 'store'])->name('product.store');

/* ============================================================
   ROUTE AUTH / LOGIN
============================================================ */
// ✅ Gunakan nama route yang berbeda agar tidak conflict
Route::post('cek_user', [ControllerAuth::class, 'login'])->name('login.process');
Route::get('/gin', function(){ return view('gin'); });
Route::post('/gin', [ControllerAuth::class, 'login'])->name('gin.login'); // ← nama diubah

/* ============================================================
   ROUTE PENILAIAN ESKUL
============================================================ */
// ✅ HANYA SATU definisi /eskul → pakai Controller
// Proteksi session sudah handled di PenilaianController@index()
Route::get('/eskul', [PenilaianController::class, 'index'])->name('eskul');
Route::get('/eskul/data', [PenilaianController::class, 'data']);
Route::post('/eskul/simpan', [PenilaianController::class, 'simpan']);

// ❌ HAPUS blok ini (duplicate route /eskul yang pakai Closure):
// Route::get('/eskul', function() {
//     if (!session('logged_in')) {
//         return redirect('/login')->with('pesan', 'Silakan login dulu');
//     }
//     return view('eskul');
// })->name('eskul');

/* ============================================================
   ROUTE BARU — untuk sistem rekap
============================================================ */
Route::post('/set-session', function(Request $request){
    session(['eskul_login' => $request->eskul]);
    return response()->json(['status' => 'ok']);
});

Route::get('/rekap', [RekapController::class, 'index'])->name('rekap.index');

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

    $model = $models[$eskul] ?? null;
    if ($model) {
        $model::query()->delete();
    }

    session()->forget('eskul_login');
    session()->forget('sudah_nilai');

    return response()->json(['status' => 'ok']);
});

Route::get('/', [KegiatanController::class, 'home']);