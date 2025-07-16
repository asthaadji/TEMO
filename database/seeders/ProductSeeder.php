<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->truncate();
        
        DB::table('products')->insert([
            [
                'id' => 3,
                'name' => 'Paket Classic',
                'description' => "Kamera DSLR profesional\nPrinter high speed (hasil cetak <10 detik)\nCetak foto unlimited\nDesain frame cetakan custom (bisa pakai nama/acara/logo)\nBackdrop custom sesuai tema acara\nProperti lengkap (topi, kacamata, papan ucapan, dsb)\nPencahayaan (lighting) profesional\nOnline gallery (akses hasil foto digital)",
                'price' => '3000000.00',
                'image' => '01K09RNRQGZJS860QXHB4ZA10H.png',
                'created_at' => '2025-07-16 07:02:06',
                'updated_at' => '2025-07-16 07:02:06',
            ],
            [
                'id' => 4,
                'name' => 'Flip-Flop Booth',
                'description' => "Cetak foto ukuran 3R\n110 Cetak foto berbahan kertas glossy black print 260gsm \nMesin mini fotolusio\nFotografer dengan Kamera terbaik\nOperator cetak \nSoftware dan Laptop khusus Photo Booth\nFree desain frame\nLighting Studio\nOptional Background Studio Standard\naksesoris foto lucu\nOnline gallery untuk unduh softcopy foto\nTemo tidak menyiapkan dekorasi",
                'price' => '4200000.00',
                'image' => '01K09RXCA7EEPYXQER9HGD22NZ.png',
                'created_at' => '2025-07-16 07:06:15',
                'updated_at' => '2025-07-16 07:06:15',
            ],
            [
                'id' => 5,
                'name' => 'Studio Photoboot',
                'description' => "Cetak foto ukuran 3R \n60 Cetak foto berbahan kertas glossy black print 260gsm \nMesin mini fotolusio\nFotografer dengan Kamera terbaik\nOperator cetak \nSoftware dan Laptop khusus Photo Booth\nFree desain frame\nLighting Studio\nOptional Background Studio Standard\naksesoris foto lucu\nOnline gallery untuk unduh softcopy foto\nTemo tidak menyiapkan dekorasi",
                'price' => '3500000.00',
                'image' => '01K09S1EV1HXSKXE11HW9A5K1T.png',
                'created_at' => '2025-07-16 07:08:29',
                'updated_at' => '2025-07-16 07:08:29',
            ],
        ]);
    }
}
