<div class="container mx-auto m-8 p-8">
<div class="container mx-auto flex flex-wrap pt-4 pb-8">
    <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
        Galeri
    </h1>
    <div class="w-full mb-4">
        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
    </div>
</div>
<div class="container mx-auto px-4 pt-5 h-75">                
<div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-6 gap-6">

            {{-- 
                Looping melalui setiap gambar. 
                Pastikan variabelnya adalah array datar, contoh: `$images`.
            --}}
            @foreach ($images as $image)
                {{-- 
                    Setiap gambar dibungkus dengan tag <a> untuk efek dan interaktivitas.
                    Kelas-kelas efek ditambahkan langsung ke <img>.
                --}}
                <a href="#" class="block">
                    <img class=" z-0 h-full w-full object-cover rounded-xl transform origin-top transition-transform duration-500 scale-100 hover:rotate-0 hover:-translate-y-12 hover:scale-125 hover:z-10
                        {{-- 
                            Ini adalah logika untuk membuat rotasi awal selang-seling.
                            Jika urutan gambar genap, miring ke kanan (rotate-6).
                            Jika ganjil, miring ke kiri (-rotate-12).
                        --}}
                        {{ $loop->iteration % 2 == 0 ? 'rotate-3' : '-rotate-3' }}"
                        src="{{ asset('images/galery/' . $image->getFilename()) }}"
                        alt="Gambar Galeri">
                </a>
            @endforeach
<div class="w-full mb-4">

</div>
        </div>
</div>
</div>
