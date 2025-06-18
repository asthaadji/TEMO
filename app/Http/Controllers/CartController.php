<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    //
    public function add(Product $product)
    {
        Cart::add($product->id, $product->name, 1, $product->price, ['image' => $product->image]);
        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function index()
    {
        $cartItems = Cart::content();
        $cartCount = Cart::count();
        // Format total harga langsung di controller
        $cartTotal = Cart::total(0, ',', '.'); 
        
        // Kirim semua data yang dibutuhkan ke view
        return view('cart.index', compact('cartItems', 'cartCount', 'cartTotal'));
        
    }

    public function remove($rowId)
    {
        Cart::remove($rowId);
        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}
