<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CobaMidtransController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PengirimanEmailController;
use App\Http\Middleware\CustomerMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [KeranjangController::class, 'daftarbarang'])->middleware([CustomerMiddleware::class])->name('depan');
Route::post('/tambah', [KeranjangController::class, 'tambahKeranjang'])->middleware([CustomerMiddleware::class]);
Route::get('/lihatkeranjang', [KeranjangController::class, 'lihatkeranjang'])->middleware([CustomerMiddleware::class]);
Route::delete('/hapus/{barang_id}', [KeranjangController::class, 'hapus'])->middleware([CustomerMiddleware::class]);
Route::get('/lihatriwayat', [KeranjangController::class, 'lihatriwayat'])->middleware([CustomerMiddleware::class]);
Route::get('/cek_status_pembayaran_pg', [KeranjangController::class, 'cek_status_pembayaran_pg']);

Route::get('/cekmidtrans', [CobaMidtransController::class, 'cekmidtrans']);

Route::get('/proses_kirim_email_pembayaran', [PengirimanEmailController::class, 'proses_kirim_email_pembayaran']);
