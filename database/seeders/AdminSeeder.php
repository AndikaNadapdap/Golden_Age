<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus admin lama jika ada
        User::where('email', 'admin@goldenage.com')->delete();

        // Buat admin baru
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@goldenage.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        echo "✅ Admin account created successfully!\n";
        echo "Email: admin@goldenage.com\n";
        echo "Password: admin123\n";
    }
}
