<div class="container mx-auto flex flex-wrap pt-4 pb-12">
    <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
        Galeri
    </h1>
    <div class="w-full mb-4">
        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
    </div>
</div>
<div class="container mx-auto flex flex-wrap pt-4 pb-12">                
<div class="grid grid-cols-2 md:grid-cols-4 gap-1">

                {{-- Looping pertama untuk setiap kolom --}}
     @foreach ($imageChunks as $chunk)
        <div class="grid gap-4">
                        
                        {{-- Looping kedua untuk setiap gambar di dalam kolom tersebut --}}
            @foreach ($chunk as $image)
                <div class="inline-block h-auto lh-0">
                                {{-- Gunakan asset() untuk membuat URL yang benar --}}
                    <img class="h-auto max-w-full rounded-lg block" src="{{ asset('images/galery/' . $image->getFilename()) }}" alt="Gambar Galeri">
                </div>
            @endforeach

        </div>
    @endforeach
 </div>
</div>
