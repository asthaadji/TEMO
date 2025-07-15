<div class="container">
    <h2>Detail Pemesanan Anda</h2>

    @if ($produkDipesan)

        <div class="produk-detail">
            <h3>{{ $produkDipesan['nama'] }}</h3>
            <p><strong>Detail:</strong> {{ $produkDipesan['detail'] }}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($produkDipesan['harga']) }}</p>
        </div>

        <hr>

        <form action="/selesaikan-pemesanan" method="POST">
            @csrf
            
            <input type="hidden" name="product_id" value="{{ $produkDipesan['id'] }}">

            <div class="form-group">
                <label for="tanggal_pemesanan">Pilih Tanggal Pemesanan</label>
                <input type="date" id="tanggal_pemesanan" name="tanggal_pemesanan" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Konfirmasi Pemesanan</button>
        </form>

    @else
        <p>Tidak ada produk yang dipilih. Silakan kembali ke halaman utama untuk memilih produk.</p>
    @endif
</div>