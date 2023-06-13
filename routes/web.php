<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\DetailPemesananController;
use App\Http\Controllers\KategoriController;
use App\Models\Kategori;
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

// Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('/admin', [UserController::class, 'adminBeranda'])->name('admin');
Route::get('/admin/kasir', [UserController::class, 'adminKasir'])->name('admin.kasir');
Route::get('/admin/admin', [UserController::class, 'adminManajer'])->name('admin.manajer');
Route::get('/admin/menu', [UserController::class, 'adminMenu'])->name('admin.menu');
Route::get('/admin/hariini', [PemesananController::class, 'index'])->name('admin.hariini');
Route::get('/admin/report', [PemesananController::class,  'reportBulan'])->name('admin.reportBulan');
Route::get('/admin/report-harian', [PemesananController::class,  'reportHarian'])->name('admin.reportHari');
Route::get('/admin/report/pemesanan/{pemesanan}', [DetailPemesananController::class, 'index'])->name('admin.reportPemesanan');



Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('admin.kategori');
Route::delete('/admin/kategori', [KategoriController::class, 'destroy'])->name('kategori.destroy');
Route::post('/admin/kategori', [KategoriController::class, 'store'])->name('kategori.store');

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::get('/kasir', [UserController::class, 'kasir'])->name('kasir.pemesanan');
Route::get('/kasir/detail/pemesanan/{pemesanan}', [DetailPemesananController::class, 'kasirDetail'])->name('kasir.detail');


Route::get('/admin/report', [PemesananController::class,  'reportBulan'])->name('admin.reportBulan');
Route::get('/admin/report-harian', [PemesananController::class,  'reportHarian'])->name('admin.reportHari');
Route::get('/admin/report/pemesanan/{pemesanan}', [DetailPemesananController::class, 'index'])->name('admin.reportPemesanan');


Route::get('/user/createkasir', [UserController::class, 'createKasir'])->name('user.createKasir');
Route::get('/user/createmanajer', [UserController::class, 'createManajer'])->name('user.createManajer');
Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/destroy', [UserController::class, 'destroy'])->name('user.destroy');
Route::post('/register', [UserController::class, 'register_action'])->name('register.action');


Route::get('/', [UserController::class, 'login'])->name('login');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'login_action'])->name('login.action');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');


Route::get('/password', [UserController::class, 'password'])->name('password');
Route::post('/password', [UserController::class, 'password_action'])->name('password.action');


Route::delete('/menu/destroy', [MenuController::class, 'destroy'])->name('menu.destroy');
Route::post('/menu/update', [MenuController::class, 'update'])->name('menu.update');
Route::post('/menu/store', [MenuController::class, 'store'])->name('menu.store');
Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
Route::post('/kategori/update', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/destroy', [KategoriController::class, 'destroy'])->name('kategori.destroy');

Route::get('/pemesanan/create', [PemesananController::class, 'create'])->name('pemesanan.create');
Route::post('/pemesanan/store', [PemesananController::class, 'store'])->name('pemesanan.store');
Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
Route::get('/pemesanan/report', [PemesananController::class, 'reportBulan'])->name('pemesanan.reportBulan');
Route::get('/detailpemesanan/{pemesanan}', [DetailPemesananController::class, 'index'])->name('detailpemesanan.detail');
