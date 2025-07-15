<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Lengkap - TeMo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
@extends('layouts.app')
@section('content')
        <!-- Section Galeri Lengkap -->
        <div class="container mx-auto px-4 pt-24 h-screen">

        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
            Produk Kami
        </h1>
        <div class="w-full mb-10">
            <div class="h-1 mx-auto bg-indigo-500 w-64 opacity-25 my-0 py-0 rounded-t"></div>
        </div>

        {{-- Grid untuk menampilkan semua produk --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

            {{-- Looping data produk dari controller --}}
            @foreach ($featuredProducts as $product)
            <div class="flex flex-col bg-white rounded-lg shadow-lg overflow-hidden">
                
                {{-- Gambar Produk --}}
                <img class="w-full h-56 object-cover object-center" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                
                <div class="p-6 flex flex-col flex-grow">
                    {{-- Nama Produk --}}
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $product->name }}</h2>
                    
                    {{-- Deskripsi Produk --}}
                    {{-- `prose` dari tailwind untuk format teks yang baik --}}
                    <div class="prose text-gray-600 mb-4 flex-grow">
                        {!! $product->description !!} {{-- Menggunakan {!! !!} jika deskripsi berisi HTML --}}
                    </div>
                    
                    {{-- Harga Produk --}}
                    <div class="text-3xl font-bold text-indigo-600 text-right mt-4">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="p-6 bg-white ">
                    <div class="flex items-center justify-center">
                        <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transform transition hover:scale-105 duration-300 ease-in-out">
                            <a href="{{ route('products.show', $product) }}" class="block text-center w-full text-white font-bold ">
                                Lihat Detail
                            </a>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
@endsection
</html>
