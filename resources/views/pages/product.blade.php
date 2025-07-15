{{-- resources/views/products/detail.blade.php --}}

@extends('layouts.app')

<section class="py-12 pt-24 h-screen">
    <div class="container mx-auto px-4">
        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-white">
            {{ $product->name }}
        </h1>
        <div class="w-full mb-10">
            <div class="h-1 mx-auto bg-indigo-500 w-64 opacity-25 my-0 py-0 rounded-t"></div>
        </div>

        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden md:flex">
            
            <div class="md:w-1/2">
                <img class="h-full w-full object-cover p-4" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            </div>

            <div class="p-8 md:w-1/2 flex flex-col justify-between">
                <div>
                    <div class="prose text-gray-600 mb-6">
                        {!! $product->description !!}
                    </div>
                </div>
                
                <div>
                    <p class="text-4xl font-bold text-indigo-600 text-right mb-6">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <form action="{{ route('pemesanan.mulai', $product->id) }}" method="POST">
                        @csrf

                        {{-- Input Tanggal --}}
                        <div class="mb-4">
                            <label for="tanggal_pemesanan" class="block text-gray-700 text-sm font-bold mb-2">
                                Pilih Tanggal Pemesanan:
                            </label>
                            <input type="date" id="tanggal_pemesanan" name="tanggal_pemesanan" 
                                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                   value="{{ old('tanggal_pemesanan') }}" required>
                        </div>
                        
                        {{-- Menampilkan Error Validasi --}}
                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transform transition hover:scale-105 duration-300 ease-in-out">
                            Pesan Produk Ini
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
