<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();

        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@temo.com',
                'email_verified_at' => null,
                // Password sudah dalam format hash, jadi tidak perlu di-hash lagi
                'password' => '$2y$12$XkEXmCxxajs8bmhboI83De5n6sAU5t3FKm91xRHGRn8IPG0IMRcR6',
                'remember_token' => null,
                'created_at' => '2025-06-13 09:06:40',
                'updated_at' => '2025-06-13 09:06:40',
                'is_admin' => 1,
            ],
            [
                'id' => 2,
                'name' => 'adji',
                'email' => 'adji@mail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$MX1fyLSwiO7Fxc4TfB7VaOobK9O04rZFSZXmZqzNMZFYChldHdDuu',
                'remember_token' => null,
                'created_at' => '2025-07-04 19:42:01',
                'updated_at' => '2025-07-04 19:42:01',
                'is_admin' => 0,
            ],
        ]);
    }
}
