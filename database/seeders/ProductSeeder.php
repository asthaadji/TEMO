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
                'id' => 2,
                'name' => 'Coba',
                'description' => '<p>adasdsadsa</p>',
                'price' => '100000000.00',
                'image' => 'products/01JZ28MVNTRATTNS5RW8KHSHA6.png',
                'created_at' => '2025-06-30 22:51:36',
                'updated_at' => '2025-06-30 22:51:36',
            ],
        ]);
    }
}
