<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PemesananController;
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


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
    /* Route::post('/keranjang/tambah/{product}', [PemesananController::class, 'tambahKeranjang'])->name('keranjang.tambah');
    Route::get('/pemesanan/detail', [PemesananController::class, 'tampilkanDetailPemesanan'])->name('pemesanan.detail'); */
    Route::post('/keranjang/hapus/{rowId}',                                                                                                                                        [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::post('/pesan/{product}', [PemesananController::class, 'mulaiPemesanan'])->name('pemesanan.mulai');
    Route::get('/pemesanan/pembayaran/{order}', [PemesananController::class, 'tampilkanPembayaran'])->name('pemesanan.pembayaran');
});
// Landing Page
Route::get('/', [PageController::class, 'landing'])->name('landing');
Route::get('/tentang',[PageController::class,'about'])->name('about');
Route::get('/galeri',[PageController::class,'gallery'])->name('gallery');
Route::get('/produk',[PageController::class,'produk'])->name('produk');
// Daftar Produk/Layanan
Route::get('/layanan', [PageController::class, 'products'])->name('products.index');
Route::get('/layanan/{product}', [PageController::class, 'productDetail'])->name('products.show');

Route::get('/produk/{product}', [PageController::class, 'show'])->name('products.show');

require __DIR__.'/auth.php';
