<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin; // Gantilah dengan model Admin
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'admin@gmail.com'],  // Menggunakan email sebagai kunci unik
            [
                'name' => 'Admin',
                'password' => Hash::make('bmkg123'),
            ]
        );
    }
}
