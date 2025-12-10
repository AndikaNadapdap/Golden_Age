<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Pentingnya 1000 Hari Pertama Kehidupan',
                'author' => 'Dr. Siti Nurhaliza, Sp.A',
                'references' => "1. Ikatan Dokter Anak Indonesia (IDAI)\n2. WHO - 1000 Days Movement\n3. Kementerian Kesehatan RI - Pedoman Gizi Seimbang",
                'content' => 'Periode 1000 hari pertama kehidupan (HPK) dimulai sejak konsepsi hingga anak berusia 2 tahun. Masa ini merupakan periode emas untuk tumbuh kembang anak yang optimal.

Mengapa 1000 HPK Penting?

1. Perkembangan Otak
   Pada periode ini, otak berkembang sangat pesat. Sekitar 80% perkembangan otak terjadi pada 1000 hari pertama.

2. Pertumbuhan Fisik
   Nutrisi yang cukup akan mendukung pertumbuhan tinggi dan berat badan yang optimal.

3. Sistem Imun
   Pemberian ASI eksklusif dan nutrisi yang tepat akan membentuk sistem kekebalan tubuh yang kuat.

Tips Mendukung 1000 HPK:
- Konsumsi makanan bergizi seimbang saat hamil
- Berikan ASI eksklusif 6 bulan pertama
- Mulai MPASI di usia 6 bulan dengan nutrisi lengkap
- Rutin memeriksakan kesehatan anak
- Berikan stimulasi sesuai usia',
                'category' => '1000 HPK',
                'excerpt' => 'Memahami pentingnya periode emas 1000 hari pertama kehidupan untuk tumbuh kembang optimal anak.',
            ],
            [
                'title' => 'Panduan Lengkap MPASI untuk Bayi 6 Bulan',
                'author' => 'Dr. Andi Wijaya, Sp.A',
                'references' => "1. Ikatan Dokter Anak Indonesia, UKK Nutrisi dan Penyakit Metabolik\n2. WHO. Infant and Young Child Feeding Model Chapter\n3. Kementerian Kesehatan RI - Buku KIA",
                'content' => 'Memasuki usia 6 bulan, bayi sudah siap menerima Makanan Pendamping ASI (MPASI). Berikut panduan lengkapnya.

Tanda Bayi Siap MPASI:
- Sudah bisa duduk dengan bantuan
- Menunjukkan ketertarikan pada makanan
- Refleks menjulurkan lidah sudah berkurang
- Berat badan sudah dua kali lipat dari lahir

Menu MPASI 6 Bulan:
1. Puree buah (pisang, alpukat, pepaya)
2. Puree sayuran (wortel, labu, brokoli)
3. Bubur tepung beras
4. Pure kentang

Prinsip MPASI:
- Tekstur halus/lumat
- Porsi bertahap dimulai 2-3 sendok
- Berikan satu jenis makanan selama 3 hari
- Perhatikan reaksi alergi
- ASI tetap diberikan

Frekuensi Pemberian:
- 6-8 bulan: 2-3 kali sehari
- Porsi: 2-3 sendok makan',
                'category' => 'Nutrisi',
                'excerpt' => 'Panduan memulai MPASI yang tepat untuk bayi 6 bulan dengan menu dan porsi yang sesuai.',
            ],
            [
                'title' => 'Stimulasi Bayi 0-3 Bulan untuk Perkembangan Optimal',
                'author' => 'Dr. Ratna Dewi, Sp.A',
                'references' => "1. American Academy of Pediatrics\n2. IDAI - Panduan Stimulasi Dini\n3. Denver Developmental Screening Test",
                'content' => 'Stimulasi sejak dini sangat penting untuk mendukung perkembangan sensorik dan motorik bayi.

Jenis Stimulasi 0-3 Bulan:

1. Stimulasi Visual
   - Gantung mainan berwarna kontras
   - Ajak bayi mengikuti gerakan benda
   - Tatap mata bayi saat bicara

2. Stimulasi Pendengaran
   - Ajak bayi bicara dengan lembut
   - Perdengarkan musik klasik
   - Bacakan buku cerita

3. Stimulasi Sentuhan
   - Pijat bayi dengan lembut
   - Skin-to-skin contact
   - Peluk dan gendong bayi

4. Stimulasi Motorik
   - Tummy time 2-3 kali sehari
   - Gerakkan kaki dan tangan bayi
   - Biarkan bayi meraih mainan

Manfaat Stimulasi:
- Meningkatkan bonding
- Mengoptimalkan perkembangan otak
- Melatih otot-otot
- Meningkatkan kepercayaan diri anak',
                'category' => 'Perkembangan',
                'excerpt' => 'Cara melakukan stimulasi yang tepat untuk bayi 0-3 bulan agar tumbuh kembang optimal.',
            ],
            [
                'title' => 'Jadwal Imunisasi Lengkap untuk Bayi dan Balita',
                'content' => 'Imunisasi adalah investasi kesehatan jangka panjang untuk anak. Berikut jadwal lengkapnya.

Imunisasi Dasar (0-12 Bulan):

Usia 0 bulan:
- Hepatitis B (HB 0)
- BCG
- Polio 0

Usia 2 bulan:
- DPT-HB-Hib 1
- Polio 1

Usia 3 bulan:
- DPT-HB-Hib 2
- Polio 2

Usia 4 bulan:
- DPT-HB-Hib 3
- Polio 3
- IPV

Usia 9 bulan:
- Campak/MR

Imunisasi Lanjutan:

Usia 18 bulan:
- DPT-HB-Hib (booster)
- Campak/MR (booster)

Usia 24 bulan:
- Imunisasi lengkap sesuai program

Tips Imunisasi:
- Catat jadwal di kalender
- Bawa buku KIA setiap kali imunisasi
- Perhatikan kondisi anak sebelum imunisasi
- Pantau reaksi setelah imunisasi',
                'category' => 'Kesehatan',
                'excerpt' => 'Jadwal imunisasi lengkap yang wajib dipenuhi untuk melindungi anak dari berbagai penyakit.',
                'author' => 'Dr. Maya Indah, Sp.A',
                'references' => "1. Kementerian Kesehatan RI - Jadwal Imunisasi Nasional\n2. IDAI - Pedoman Imunisasi\n3. WHO Immunization Schedule",
            ],
            [
                'title' => 'Tips Menyusui untuk Ibu Baru',
                'author' => 'Dr. Laila Nurjannah, Sp.OG',
                'references' => "1. La Leche League International\n2. WHO - Breastfeeding Recommendations\n3. IDAI - Panduan ASI Eksklusif",
                'content' => 'Menyusui adalah proses alami namun perlu dipelajari. Berikut tips sukses menyusui untuk ibu baru.

Persiapan Menyusui:

1. Sejak Hamil:
   - Pelajari teknik menyusui
   - Ikuti kelas laktasi
   - Siapkan mental

2. Setelah Melahirkan:
   - IMD dalam 1 jam pertama
   - Rawat gabung dengan bayi
   - Menyusui sesering mungkin

Posisi Menyusui:
- Cradle hold
- Cross-cradle hold
- Football hold
- Side-lying position

Tanda Pelekatan Benar:
- Mulut bayi terbuka lebar
- Bibir bayi keluar
- Dagu menempel payudara
- Tidak terdengar bunyi decak

Atasi Masalah Umum:

Puting Lecet:
- Perbaiki pelekatan
- Gunakan krim lanolin
- Jemur payudara

ASI Sedikit:
- Perbanyak frekuensi menyusui
- Makan bergizi
- Istirahat cukup
- Kelola stres

Ingat: ASI eksklusif 6 bulan tanpa tambahan apapun!',
                'category' => 'Nutrisi',
                'excerpt' => 'Panduan lengkap menyusui untuk ibu baru agar ASI lancar dan bayi tumbuh sehat.',
            ],
            [
                'title' => 'Milestone Perkembangan Bayi 0-12 Bulan',
                'author' => 'Dr. Budi Santoso, Sp.A',
                'references' => "1. WHO Child Growth Standards\n2. Centers for Disease Control and Prevention (CDC)\n3. IDAI - Milestone Perkembangan Anak",
                'content' => 'Setiap bayi berkembang dengan kecepatannya sendiri, namun ada milestone yang perlu diperhatikan.

Perkembangan 0-3 Bulan:
- Mengangkat kepala saat tengkurap
- Mengikuti benda dengan mata
- Tersenyum sosial
- Menggenggam jari
- Mendengar suara

Perkembangan 4-6 Bulan:
- Tengkurap sendiri
- Duduk dengan bantuan
- Meraih dan memegang mainan
- Tertawa
- Babbling (mengoceh)

Perkembangan 7-9 Bulan:
- Duduk tanpa bantuan
- Merangkak
- Berdiri berpegangan
- Memindahkan benda
- Mengerti namanya

Perkembangan 10-12 Bulan:
- Berdiri sendiri
- Melangkah berpegangan
- Mengucapkan kata pertama
- Melambaikan tangan
- Bermain cilukba

Kapan Harus Konsultasi:
- Tidak ada kontak mata
- Tidak tersenyum di 3 bulan
- Tidak bisa duduk di 9 bulan
- Tidak babbling di 12 bulan
- Kehilangan kemampuan yang sudah dikuasai',
                'category' => 'Perkembangan',
                'excerpt' => 'Mengenal tahapan perkembangan bayi dari 0-12 bulan dan tanda yang perlu diwaspadai.',
                'author' => 'Dr. Budi Santoso, Sp.A',
                'references' => "1. WHO Child Growth Standards\n2. Centers for Disease Control and Prevention (CDC)\n3. IDAI - Milestone Perkembangan Anak",
            ],
        ];

        // Get admin user
        $admin = User::where('role', 'admin')->first();

        foreach ($articles as $articleData) {
            Article::create([
                'user_id' => $admin->id,
                'title' => $articleData['title'],
                'slug' => Str::slug($articleData['title']),
                'content' => $articleData['content'],
                'excerpt' => $articleData['excerpt'],
                'category' => $articleData['category'],
                'author' => $articleData['author'],
                'references' => $articleData['references'] ?? null,
                'is_published' => true,
                'published_at' => now()->subDays(rand(1, 30)),
                'views' => rand(50, 500),
            ]);
        }
    }
}
