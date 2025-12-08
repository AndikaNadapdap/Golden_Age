<?php

namespace Database\Seeders;

use App\Models\Stimulation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StimulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stimulations = [
            [
                'title' => 'Tummy Time untuk Bayi 0-3 Bulan',
                'slug' => Str::slug('Tummy Time untuk Bayi 0-3 Bulan'),
                'description' => 'Aktivitas tengkurap untuk menguatkan otot leher dan punggung bayi',
                'category' => 'Motorik Kasar',
                'age_range' => '0-3 bulan',
                'materials' => 'Alas empuk, mainan warna-warni',
                'instructions' => "1. Letakkan bayi dalam posisi tengkurap di atas alas empuk\n2. Pastikan kepala bayi menghadap ke samping\n3. Letakkan mainan warna-warni di depan bayi untuk menarik perhatiannya\n4. Lakukan selama 3-5 menit beberapa kali sehari\n5. Awasi bayi dengan cermat selama aktivitas",
                'benefits' => 'Menguatkan otot leher, punggung, dan bahu; Mencegah kepala peyang; Melatih koordinasi mata dan tangan; Mempersiapkan kemampuan merangkak',
                'duration' => '3-5 menit',
                'likes' => 45,
            ],
            [
                'title' => 'Bermain Cilukba',
                'slug' => Str::slug('Bermain Cilukba'),
                'description' => 'Permainan klasik untuk melatih kemampuan sosial dan kognitif bayi',
                'category' => 'Sosial-Emosional',
                'age_range' => '4-6 bulan',
                'materials' => 'Tangan atau kain tipis',
                'instructions' => "1. Tutup wajah Anda dengan tangan atau kain\n2. Katakan 'Cilukba!' sambil membuka penutup\n3. Tunjukkan ekspresi wajah yang ceria\n4. Ulangi beberapa kali dengan variasi\n5. Biarkan bayi mencoba menutup wajahnya sendiri",
                'benefits' => 'Mengajarkan konsep permanen objek; Melatih interaksi sosial; Mengembangkan rasa percaya; Merangsang perkembangan bahasa; Membangun ikatan emosional',
                'duration' => '5-10 menit',
                'likes' => 62,
            ],
            [
                'title' => 'Menggenggam Mainan Kecil',
                'slug' => Str::slug('Menggenggam Mainan Kecil'),
                'description' => 'Melatih kemampuan motorik halus dengan menggenggam benda',
                'category' => 'Motorik Halus',
                'age_range' => '4-6 bulan',
                'materials' => 'Mainan kerincing, teether, kain bertekstur',
                'instructions' => "1. Berikan mainan yang mudah digenggam ke bayi\n2. Dekatkan mainan ke tangan bayi\n3. Biarkan bayi menyentuh dan menggenggam\n4. Pindahkan mainan dari satu tangan ke tangan lain\n5. Gunakan mainan dengan tekstur berbeda",
                'benefits' => 'Mengembangkan kekuatan genggaman; Melatih koordinasi mata-tangan; Mengenal tekstur berbeda; Merangsang sensor taktil',
                'duration' => '10-15 menit',
                'likes' => 38,
            ],
            [
                'title' => 'Bermain Balok Susun',
                'slug' => Str::slug('Bermain Balok Susun'),
                'description' => 'Aktivitas menyusun balok untuk melatih kreativitas dan koordinasi',
                'category' => 'Kognitif',
                'age_range' => '10-12 bulan',
                'materials' => 'Balok kayu atau plastik berwarna, berbagai ukuran',
                'instructions' => "1. Tunjukkan cara menyusun balok\n2. Biarkan bayi memegang dan merasakan balok\n3. Susun 2-3 balok dan biarkan bayi menjatuhkannya\n4. Dorong bayi untuk mencoba menyusun sendiri\n5. Apresiasi setiap usaha bayi",
                'benefits' => 'Melatih koordinasi tangan-mata; Mengembangkan pemecahan masalah; Mengenal konsep sebab-akibat; Melatih kesabaran; Mengasah kreativitas',
                'duration' => '15-20 menit',
                'likes' => 51,
            ],
            [
                'title' => 'Bernyanyi dan Bertepuk Tangan',
                'slug' => Str::slug('Bernyanyi dan Bertepuk Tangan'),
                'description' => 'Aktivitas musik untuk merangsang perkembangan bahasa dan ritme',
                'category' => 'Bahasa',
                'age_range' => '7-9 bulan',
                'materials' => 'Tidak ada (cukup tangan dan suara)',
                'instructions' => "1. Nyanyikan lagu anak-anak sederhana\n2. Tepuk tangan mengikuti irama\n3. Pegang tangan bayi dan tepukkan bersama\n4. Gunakan gerakan sederhana yang mudah ditiru\n5. Ulangi lagu favorit bayi",
                'benefits' => 'Mengembangkan kemampuan bahasa; Melatih pendengaran; Mengenalkan ritme dan musik; Meningkatkan ikatan emosional; Melatih koordinasi gerakan',
                'duration' => '10-15 menit',
                'likes' => 56,
            ],
            [
                'title' => 'Merangkak Mengejar Bola',
                'slug' => Str::slug('Merangkak Mengejar Bola'),
                'description' => 'Permainan untuk mendorong bayi aktif merangkak',
                'category' => 'Motorik Kasar',
                'age_range' => '7-9 bulan',
                'materials' => 'Bola kecil yang mudah digenggam, ruang terbuka',
                'instructions' => "1. Letakkan bayi dalam posisi merangkak\n2. Gelindingkan bola perlahan di depan bayi\n3. Dorong bayi untuk merangkak mengejar bola\n4. Berikan pujian saat bayi berhasil menyentuh bola\n5. Tingkatkan jarak secara bertahap",
                'benefits' => 'Menguatkan otot lengan dan kaki; Melatih keseimbangan; Mengembangkan koordinasi; Meningkatkan kepercayaan diri; Mempersiapkan kemampuan berjalan',
                'duration' => '10-15 menit',
                'likes' => 43,
            ],
        ];

        foreach ($stimulations as $stimulation) {
            Stimulation::create($stimulation);
        }
    }
}
