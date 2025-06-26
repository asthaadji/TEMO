<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Semua Produk & Layanan') }}
        </h2>
    </x-slot>

    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                
                @forelse ($products as $product)
                    <x-product-card :product="$product" />
                @empty
                    <p class="col-span-full text-center text-gray-500">Saat ini belum ada produk yang tersedia.</p>
                @endforelse

            </div>
            
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>