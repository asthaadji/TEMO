<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart; // Menggunakan facade dari package bumbummen99/shoppingcart

class CartController extends Controller
{
    /**
     * Menambahkan produk ke keranjang dengan tanggal pemesanan yang spesifik.
     * Kuantitas akan selalu 1 karena setiap item unik berdasarkan tanggal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request, Product $product)
    {
        // Validasi input tanggal dari form. Wajib diisi dan tidak boleh tanggal yang sudah lewat.
        $request->validate([
            'order_date' => 'required|date|after_or_equal:today',
        ], [
            'order_date.required' => 'Tanggal pemesanan wajib diisi.',
            'order_date.date' => 'Format tanggal tidak valid.',
            'order_date.after_or_equal' => 'Tanggal pemesanan tidak boleh tanggal yang sudah lewat.',
        ]);

        $orderDate = $request->input('order_date');

        // Menambahkan item ke keranjang.
        // Setiap kombinasi produk dan tanggal akan menjadi item yang unik di dalam keranjang.
        Cart::add([
            'id'      => $product->id,
            'name'    => $product->name,
            'qty'     => 1, // Kuantitas selalu 1 karena berbasis tanggal
            'price'   => $product->price,
            'weight'  => 0, // Wajib diisi oleh package, kita set 0 saja karena tidak relevan
            'options' => [
                'image' => $product->image,
                // Pastikan model Product Anda memiliki properti/kolom 'details'
                'details' => $product->details, 
                'order_date' => $orderDate,
            ]
        ]);

        // Redirect ke halaman keranjang dengan pesan sukses
        return redirect()->route('cart.index')->with('success', 'Layanan berhasil ditambahkan ke keranjang!');
    }

    /**
     * Menampilkan halaman keranjang belanja.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cartItems = Cart::content();
        $cartCount = Cart::count();
        // Format total harga langsung di controller untuk ditampilkan di view
        $cartTotal = Cart::total(0, ',', '.'); 

        // Kirim semua data yang dibutuhkan ke view
        return view('cart.index', compact('cartItems', 'cartCount', 'cartTotal'));
    }

    /**
     * Menghapus item dari keranjang berdasarkan rowId uniknya.
     *
     * @param  string  $rowId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($rowId)
    {
        Cart::remove($rowId);
        return back()->with('success', 'Layanan berhasil dihapus dari keranjang.');
    }
}
