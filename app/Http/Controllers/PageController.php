<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
     /**
     * Menampilkan halaman landing page utama.
     * Biasanya menampilkan beberapa produk unggulan.
     */
    public function landing()
    {
         // 1. Tentukan path ke folder galeri Anda
        $path = public_path('images/galery');

        // 2. Ambil semua file dari path tersebut
        $files = File::files($path);

        // 3. (Opsional) Filter hanya untuk file gambar jika ada file lain di folder
        $images = array_filter($files, function ($file) {
            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
            return in_array(strtolower($file->getExtension()), $imageExtensions);
        });

        // 4. Bagi array gambar menjadi 4 bagian (untuk 4 kolom)
        // Ini adalah kunci untuk membuat layout masonry tetap berfungsi
        /* $imageChunks = array_chunk($images, ceil(count($images) / 4)); */
        
        
        $featuredProducts = Product::latest()->take(4)->get();
        
        return view('landing', [
        'images'      => $images,
        'featuredProducts' => $featuredProducts,
        ]);

        
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

    public function show(Product $product)
    {
        // Laravel secara otomatis akan mencari produk berdasarkan ID dari URL.
        // Kita hanya perlu melempar data produk ke view.
        return view('pages.product', ['product' => $product]);
    }

    public function gallery()
    {
        $path = public_path('images/galery');

        // 2. Ambil semua file dari path tersebut
        $files = File::files($path);

        // 3. (Opsional) Filter hanya untuk file gambar jika ada file lain di folder
        $images = array_filter($files, function ($file) {
            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'];
            return in_array(strtolower($file->getExtension()), $imageExtensions);
        });

        return view('gallery', compact('images'));
    }


    public function produk()
    {
        $featuredProducts = Product::latest()->take(4)->get();
        $products = Product::latest()->paginate(12);
        return view('produk', [
            'products'      => $products,
            'featuredProducts' => $featuredProducts,
        ]);
    }
    
    public function about()
    {
        return view('about');
    }
}
