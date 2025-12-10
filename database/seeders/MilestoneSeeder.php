<?php

namespace Database\Seeders;

use App\Models\Milestone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MilestoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $milestones = [
            // 0-3 Bulan - Motorik Kasar
            [
                'category' => 'Motorik Kasar',
                'age_range' => '0-3 bulan',
                'min_age_months' => 0,
                'max_age_months' => 3,
                'title' => 'Mengangkat Kepala Saat Tengkurap',
                'description' => 'Bayi dapat mengangkat kepala sebentar saat dalam posisi tengkurap',
                'tips' => 'Lakukan tummy time rutin 3-5 menit beberapa kali sehari'
            ],
            [
                'category' => 'Motorik Kasar',
                'age_range' => '0-3 bulan',
                'min_age_months' => 0,
                'max_age_months' => 3,
                'title' => 'Menendang Kaki',
                'description' => 'Bayi aktif menendang-nendang kaki saat telentang',
                'tips' => 'Berikan ruang bebas untuk bayi bergerak tanpa dibedong terlalu kencang'
            ],
            
            // 0-3 Bulan - Motorik Halus
            [
                'category' => 'Motorik Halus',
                'age_range' => '0-3 bulan',
                'min_age_months' => 0,
                'max_age_months' => 3,
                'title' => 'Menggenggam Jari',
                'description' => 'Bayi dapat menggenggam jari yang diletakkan di telapak tangannya',
                'tips' => 'Letakkan jari atau mainan kecil di telapak tangan bayi untuk melatih refleks genggam'
            ],
            [
                'category' => 'Motorik Halus',
                'age_range' => '0-3 bulan',
                'min_age_months' => 0,
                'max_age_months' => 3,
                'title' => 'Membuka dan Menutup Tangan',
                'description' => 'Bayi mulai membuka dan menutup tangannya',
                'tips' => 'Pijat lembut telapak tangan bayi dan berikan mainan dengan tekstur berbeda'
            ],
            
            // 0-3 Bulan - Kognitif
            [
                'category' => 'Kognitif',
                'age_range' => '0-3 bulan',
                'min_age_months' => 0,
                'max_age_months' => 3,
                'title' => 'Mengikuti Objek dengan Mata',
                'description' => 'Bayi dapat mengikuti gerakan objek atau wajah dengan matanya',
                'tips' => 'Gerakkan mainan warna-warni perlahan di depan bayi dari kiri ke kanan'
            ],
            [
                'category' => 'Kognitif',
                'age_range' => '0-3 bulan',
                'min_age_months' => 0,
                'max_age_months' => 3,
                'title' => 'Mengenali Wajah Orang Tua',
                'description' => 'Bayi mulai mengenali dan merespon wajah orang tua',
                'tips' => 'Sering bertatapan muka dan berbicara dengan bayi'
            ],
            
            // 4-6 Bulan - Motorik Kasar
            [
                'category' => 'Motorik Kasar',
                'age_range' => '4-6 bulan',
                'min_age_months' => 4,
                'max_age_months' => 6,
                'title' => 'Berguling',
                'description' => 'Bayi dapat berguling dari telentang ke tengkurap dan sebaliknya',
                'tips' => 'Beri ruang aman untuk bayi berlatih berguling, letakkan mainan di samping untuk memotivasinya'
            ],
            [
                'category' => 'Motorik Kasar',
                'age_range' => '4-6 bulan',
                'min_age_months' => 4,
                'max_age_months' => 6,
                'title' => 'Duduk dengan Bantuan',
                'description' => 'Bayi dapat duduk dengan disangga atau bantuan bantal',
                'tips' => 'Bantu bayi duduk dengan menopang punggungnya, lakukan bertahap'
            ],
            
            // 4-6 Bulan - Motorik Halus
            [
                'category' => 'Motorik Halus',
                'age_range' => '4-6 bulan',
                'min_age_months' => 4,
                'max_age_months' => 6,
                'title' => 'Meraih dan Menggenggam Mainan',
                'description' => 'Bayi dapat meraih dan menggenggam mainan dengan kedua tangan',
                'tips' => 'Berikan mainan dengan ukuran yang sesuai untuk digenggam bayi'
            ],
            [
                'category' => 'Motorik Halus',
                'age_range' => '4-6 bulan',
                'min_age_months' => 4,
                'max_age_months' => 6,
                'title' => 'Memindahkan Benda dari Tangan ke Tangan',
                'description' => 'Bayi dapat memindahkan mainan dari satu tangan ke tangan lain',
                'tips' => 'Berikan mainan kecil yang mudah dipindahkan antar tangan'
            ],
            
            // 7-9 Bulan - Motorik Kasar
            [
                'category' => 'Motorik Kasar',
                'age_range' => '7-9 bulan',
                'min_age_months' => 7,
                'max_age_months' => 9,
                'title' => 'Duduk Sendiri Tanpa Bantuan',
                'description' => 'Bayi dapat duduk sendiri tanpa topangan',
                'tips' => 'Biarkan bayi berlatih duduk dengan pengawasan, letakkan bantal di sekitarnya untuk keamanan'
            ],
            [
                'category' => 'Motorik Kasar',
                'age_range' => '7-9 bulan',
                'min_age_months' => 7,
                'max_age_months' => 9,
                'title' => 'Merangkak',
                'description' => 'Bayi mulai merangkak atau bergerak dengan cara lain (army crawl)',
                'tips' => 'Beri ruang aman untuk merangkak, letakkan mainan di depan untuk memotivasinya'
            ],
            
            // 7-9 Bulan - Bahasa
            [
                'category' => 'Bahasa',
                'age_range' => '7-9 bulan',
                'min_age_months' => 7,
                'max_age_months' => 9,
                'title' => 'Mengoceh dengan Suku Kata',
                'description' => 'Bayi mengoceh dengan suku kata seperti "ba-ba", "ma-ma", "da-da"',
                'tips' => 'Ajak bayi berbicara dan ulangi ocehannya untuk mendorong komunikasi'
            ],
            [
                'category' => 'Bahasa',
                'age_range' => '7-9 bulan',
                'min_age_months' => 7,
                'max_age_months' => 9,
                'title' => 'Merespon Nama',
                'description' => 'Bayi merespon saat namanya dipanggil',
                'tips' => 'Sering panggil nama bayi dengan nada ceria'
            ],
            
            // 10-12 Bulan - Motorik Kasar
            [
                'category' => 'Motorik Kasar',
                'age_range' => '10-12 bulan',
                'min_age_months' => 10,
                'max_age_months' => 12,
                'title' => 'Berdiri dengan Berpegangan',
                'description' => 'Bayi dapat berdiri sambil berpegangan pada furniture',
                'tips' => 'Pastikan furniture stabil dan aman untuk bayi berpegangan'
            ],
            [
                'category' => 'Motorik Kasar',
                'age_range' => '10-12 bulan',
                'min_age_months' => 10,
                'max_age_months' => 12,
                'title' => 'Berjalan dengan Berpegangan',
                'description' => 'Bayi mulai melangkah sambil berpegangan (cruising)',
                'tips' => 'Berikan pegangan yang aman dan dampingi bayi saat berlatih berjalan'
            ],
            
            // 10-12 Bulan - Motorik Halus
            [
                'category' => 'Motorik Halus',
                'age_range' => '10-12 bulan',
                'min_age_months' => 10,
                'max_age_months' => 12,
                'title' => 'Menggunakan Jari Telunjuk dan Ibu Jari (Pincer Grasp)',
                'description' => 'Bayi dapat mengambil benda kecil dengan ibu jari dan telunjuk',
                'tips' => 'Berikan finger food atau mainan kecil untuk melatih pincer grasp'
            ],
            [
                'category' => 'Motorik Halus',
                'age_range' => '10-12 bulan',
                'min_age_months' => 10,
                'max_age_months' => 12,
                'title' => 'Memasukkan Benda ke Wadah',
                'description' => 'Bayi dapat memasukkan dan mengeluarkan benda dari wadah',
                'tips' => 'Sediakan wadah dan mainan kecil untuk permainan masuk-keluar'
            ],
            
            // Sosial-Emosional
            [
                'category' => 'Sosial-Emosional',
                'age_range' => '4-6 bulan',
                'min_age_months' => 4,
                'max_age_months' => 6,
                'title' => 'Tersenyum dan Tertawa',
                'description' => 'Bayi tersenyum dan tertawa sebagai respon sosial',
                'tips' => 'Sering bermain dan berinteraksi dengan bayi, tunjukkan ekspresi ceria'
            ],
            [
                'category' => 'Sosial-Emosional',
                'age_range' => '7-9 bulan',
                'min_age_months' => 7,
                'max_age_months' => 9,
                'title' => 'Stranger Anxiety',
                'description' => 'Bayi menunjukkan kecemasan atau takut pada orang asing',
                'tips' => 'Ini adalah fase normal, berikan kenyamanan dan jangan paksa bayi berinteraksi dengan orang asing'
            ],
            [
                'category' => 'Sosial-Emosional',
                'age_range' => '10-12 bulan',
                'min_age_months' => 10,
                'max_age_months' => 12,
                'title' => 'Meniru Gestur Sederhana',
                'description' => 'Bayi dapat meniru gestur seperti melambaikan tangan, bertepuk tangan',
                'tips' => 'Ajarkan gestur sederhana sambil bernyanyi atau bermain'
            ],
        ];

        foreach ($milestones as $milestone) {
            $milestone['slug'] = Str::slug($milestone['title']);
            Milestone::create($milestone);
        }
    }
}
