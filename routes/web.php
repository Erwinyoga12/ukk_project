<?php
use App\Http\Controllers\AdControlller;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ControllerAuth;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KegiatanController;
//use App\Http\Controllers\post\controllerPost;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route ::get('/halo',function(){
//    return view('coba.halo');
// });

// Route::get('/slha',[controllerPost::class, 'inde']);


// Route::get('/set', function (){
//     return view ('index');
// });

// Route::get('/abc', function (){
//     return view ('contact');
// });

// Route::get('/pres', function (){
//     return view ('prestasi');
// });

// Route::get('/pro', function (){
//     return view ('profil');
// });

// Route::get('/log', function (){
//     return view ('login');
// });

// Route::get('/cek', function (){
//     return view ('cek_user')
// })

Route::get('/kegiatan',[KegiatanController::class, 'keg']);

Route::get('/profil',[ProfilController::class, 'prof']);

Route::get('/index',[KegiatanController::class, 'index']);

Route::get('/prestasi',[KegiatanController::class, 'pres']);

Route::get('/home',[KegiatanController::class, 'home']);

Route::get('/gin ',[KegiatanController::class, 'gin']);

Route::get('/prmkrekap ',[KegiatanController::class, 'rkpPramuka']);

Route::get('/gotapramu ',[KegiatanController::class, 'gotapramuka']);

Route::get('/eskul ',[KegiatanController::class, 'eskul']);

Route::get('/contact',[ContactController::class, 'con'])->name('contact.index');

Route::get('/users',[UserController::class, 'tambahdata']);

Route::post('contact',[ContactController::class, 'store'])->name('contact.store');

// Route::get('/login',[ControllerAuth::class, 'index'])->name('login');
Route::post('cek_user',[ControllerAuth::class, 'cek_akun'])->name('cek_user');
Route::get('/dashboard',[AdControlller::class, 'dash'])->name('dashboard');
Route::get('/customer',[CustomerController::class, 'cus'])->name('customer.cus');
Route::post('/customer',[CustomerController::class, 'store'])->name('customer.store');
// route::get('/Jurusan', [KegiatanController::class,'Jurusan']);

Route::get('/product',[ProductController::class, 'pro'])->name('product.pro');
Route::post('/product',[ProductController::class, 'store'])->name('product.store');

Route::get('/login', function (){
    return view ('login');
});

Route::get('/dashboard', function (){
    return view ('dashboard');
});

