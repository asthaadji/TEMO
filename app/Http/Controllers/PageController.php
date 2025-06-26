<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
     /**
     * Menampilkan halaman landing page utama.
     * Biasanya menampilkan beberapa produk unggulan.
     */
    public function landing()
    {
        // Ambil 4 produk terbaru sebagai produk unggulan
        $featuredProducts = Product::latest()->take(4)->get();
        
        return view('landing', compact('featuredProducts'));
    }

    /**
     * Menampilkan halaman daftar semua produk dengan paginasi.
     */
    public function products()
    {
        // Ambil semua produk, urutkan dari yang terbaru, dan gunakan paginasi
        $products = Product::latest()->paginate(12);
        
        return view('products.index', compact('products'));
    }

    /**
     * Menampilkan halaman detail untuk satu produk.
     * Menggunakan Route-Model Binding untuk kemudahan.
     */
    public function productDetail(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
