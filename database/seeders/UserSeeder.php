<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\DoctorProfile;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun dokter
        $doctors = [
            [
                'name' => 'Dr. Budi Santoso, Sp.A',
                'email' => 'dr.budi@goldenage.com',
                'password' => bcrypt('dokter123'),
                'role' => 'doctor',
                'status' => 'approved',
                'profile' => [
                    'str_number' => 'STR-12345678',
                    'specialization' => 'Spesialis Anak',
                    'hospital_name' => 'RS Harapan Sehat',
                    'phone_number' => '081234567890',
                    'years_of_experience' => 10,
                ]
            ],
            [
                'name' => 'Dr. Siti Rahmawati, Sp.A',
                'email' => 'dr.siti@goldenage.com',
                'password' => bcrypt('dokter123'),
                'role' => 'doctor',
                'status' => 'approved',
                'profile' => [
                    'str_number' => 'STR-87654321',
                    'specialization' => 'Spesialis Anak & Tumbuh Kembang',
                    'hospital_name' => 'RS Bunda Sehat',
                    'phone_number' => '081298765432',
                    'years_of_experience' => 8,
                ]
            ],
            [
                'name' => 'Dr. Ahmad Hidayat, Sp.A',
                'email' => 'dr.ahmad@goldenage.com',
                'password' => bcrypt('dokter123'),
                'role' => 'doctor',
                'status' => 'approved',
                'profile' => [
                    'str_number' => 'STR-11223344',
                    'specialization' => 'Spesialis Anak',
                    'hospital_name' => 'RS Medika Utama',
                    'phone_number' => '081355667788',
                    'years_of_experience' => 12,
                ]
            ],
        ];

        foreach ($doctors as $doctorData) {
            $profile = $doctorData['profile'];
            unset($doctorData['profile']);

            $doctor = User::create($doctorData);
            
            DoctorProfile::create([
                'user_id' => $doctor->id,
                'str_number' => $profile['str_number'],
                'specialization' => $profile['specialization'],
                'hospital_name' => $profile['hospital_name'],
                'phone_number' => $profile['phone_number'],
                'years_of_experience' => $profile['years_of_experience'],
            ]);

            echo "✅ Doctor account created: {$doctorData['email']}\n";
        }

        // Buat akun orang tua
        $parents = [
            [
                'name' => 'Ibu Sarah Wijaya',
                'email' => 'sarah@example.com',
                'password' => bcrypt('parent123'),
                'role' => 'parent',
                'status' => 'active',
            ],
            [
                'name' => 'Bapak Andi Pratama',
                'email' => 'andi@example.com',
                'password' => bcrypt('parent123'),
                'role' => 'parent',
                'status' => 'active',
            ],
            [
                'name' => 'Ibu Dewi Lestari',
                'email' => 'dewi@example.com',
                'password' => bcrypt('parent123'),
                'role' => 'parent',
                'status' => 'active',
            ],
            [
                'name' => 'Bapak Rudi Hermawan',
                'email' => 'rudi@example.com',
                'password' => bcrypt('parent123'),
                'role' => 'parent',
                'status' => 'active',
            ],
            [
                'name' => 'Ibu Linda Kusuma',
                'email' => 'linda@example.com',
                'password' => bcrypt('parent123'),
                'role' => 'parent',
                'status' => 'active',
            ],
        ];

        foreach ($parents as $parentData) {
            User::create($parentData);
            echo "✅ Parent account created: {$parentData['email']}\n";
        }

        echo "\n📋 DAFTAR AKUN YANG DIBUAT:\n";
        echo "====================================\n";
        echo "DOKTER (password: dokter123):\n";
        echo "  - dr.budi@goldenage.com\n";
        echo "  - dr.siti@goldenage.com\n";
        echo "  - dr.ahmad@goldenage.com\n";
        echo "\nORANG TUA (password: parent123):\n";
        echo "  - sarah@example.com\n";
        echo "  - andi@example.com\n";
        echo "  - dewi@example.com\n";
        echo "  - rudi@example.com\n";
        echo "  - linda@example.com\n";
        echo "====================================\n";
    }
}
