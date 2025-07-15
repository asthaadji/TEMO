<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/**
 * Mengelola alur pemesanan produk tunggal dengan validasi tanggal
 * dan integrasi pembayaran Tripay.
 */
class PemesananController extends Controller
{
    /**
     * Memulai proses pemesanan dari halaman produk.
     * Metode ini memvalidasi ketersediaan tanggal, membuat order,
     * dan menginisiasi transaksi ke Tripay.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mulaiPemesanan(Request $request, Product $product)
    {
        // 1. Validasi Input Tanggal dari form
        $validator = Validator::make($request->all(), [
            'tanggal_pemesanan' => 'required|date|after_or_equal:today',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();
        $tanggalPemesanan = $validated['tanggal_pemesanan'];

        // 2. Cek Ketersediaan Tanggal untuk Produk Ini di database
        $isBooked = Order::where('product_id', $product->id)
                         ->where('tanggal_pemesanan', $tanggalPemesanan)
                         ->whereIn('status', ['pending', 'success']) // Cek pesanan yang masih aktif atau sudah berhasil
                         ->exists();

        if ($isBooked) {
            return back()
                ->withErrors(['tanggal_pemesanan' => 'Tanggal ini sudah dipesan. Silakan pilih tanggal lain.'])
                ->withInput();
        }

        // 3. Validasi Konfigurasi Tripay
        $tripayConfig = config('services.tripay');
        if (
            !$tripayConfig ||
            empty($tripayConfig['merchant_code']) ||
            empty($tripayConfig['private_key']) ||
            empty($tripayConfig['api_key']) ||
            empty($tripayConfig['api_url'])
        ) {
            // Log error untuk developer, ini tidak akan ditampilkan ke user.
            Log::error('Konfigurasi Tripay tidak lengkap. Pastikan file .env dan config/services.php sudah benar.');

            // Tampilkan pesan error yang lebih ramah ke user.
            return back()
                ->withErrors(['tanggal_pemesanan' => 'Layanan pembayaran sedang mengalami gangguan. Silakan coba lagi nanti.'])
                ->withInput();
        }

        // 4. Siapkan data dan kirim request ke Tripay
        $merchantRef = 'TEMO-' . time();
        $totalAmount = (int)$product->price;
        $metodePembayaran = 'QRIS';
        
        $signature = hash_hmac(
            'sha256',
            $tripayConfig['merchant_code'] . $merchantRef . $totalAmount,
            $tripayConfig['private_key']
        );

        $data = [
            'method'         => $metodePembayaran,
            'merchant_ref'   => $merchantRef,
            'amount'         => $totalAmount,
            'customer_name'  => Auth::user()->name,
            'customer_email' => Auth::user()->email,
            'order_items'    => [[
                'sku'      => 'PROD-' . $product->id,
                'name'     => $product->name,
                'price'    => $product->price,
                'quantity' => 1,
            ]],
            'signature'      => $signature,
            'expired_time'   => (time() + (24 * 60 * 60)), // 24 jam
        ];
        
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $tripayConfig['api_key']])
                        ->post('https://tripay.co.id/api-sandbox/transaction/create', $data);
        $result = $response->json();

        // 5. Proses respons dari Tripay dengan validasi yang lebih kuat
        if ($result && isset($result['success']) && $result['success'] && isset($result['data'])) {
            // Jika berhasil, BARU BUAT record order di database dengan semua data sekaligus.
            $order = Order::create([
                'user_id'           => Auth::id(),
                'product_id'        => $product->id,
                'tanggal_pemesanan' => $tanggalPemesanan,
                'merchant_ref'      => $merchantRef,
                'total_amount'      => $totalAmount,
                'status'            => 'pending', // Status awal, bisa diupdate via callback Tripay
                'tripay_reference'  => $result['data']['reference'],
                'payment_method'    => $result['data']['payment_name'],
                'invoice_number'    => $result['data']['pay_code'] ?? null,
                'payment_url'       => $result['data']['qr_url'] ?? null,
            ]);
            
            // Arahkan ke halaman pembayaran
            return redirect()->route('pemesanan.pembayaran', ['order' => $order->id]);
        } else {
            // Tangani kasus kegagalan dengan pesan error yang lebih informatif
            $errorMessage = 'Gagal membuat transaksi pembayaran.';
            if ($result && isset($result['message'])) {
                 $errorMessage = 'Gagal membuat transaksi: ' . $result['message'];
            } else {
                 $errorMessage .= ' Tidak ada respons valid dari layanan pembayaran.';
            }

            // Jika gagal, tidak ada order yang dibuat, jadi tidak perlu dihapus.
            return back()
                ->withErrors(['tanggal_pemesanan' => $errorMessage])
                ->withInput();
        }
    }

    /**
     * Menampilkan halaman pembayaran (QR Code, dll) untuk order yang spesifik.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function tampilkanPembayaran(Order $order)
    {
        // Pastikan hanya pemilik order yang bisa mengakses halaman ini
        if ($order->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        return view('pemesanan.pembayaran', ['order' => $order]);
    }
}
