<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Discussion;
use App\Models\DiscussionReply;
use App\Models\User;
use Illuminate\Support\Str;

class DiscussionSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@goldenage.com',
                'password' => bcrypt('password'),
            ]);
        }

        $discussions = [
            [
                'title' => 'Bagaimana cara mengenalkan MPASI pertama kali?',
                'slug' => Str::slug('Bagaimana cara mengenalkan MPASI pertama kali?'),
                'content' => 'Halo semua, bayi saya sudah memasuki usia 6 bulan dan saya ingin mulai memberikan MPASI. Saya masih bingung harus mulai dari mana. Apakah langsung bubur atau pure buah dulu? Bagaimana jadwal yang tepat? Mohon sharing pengalamannya ya!',
                'category' => 'MPASI',
                'user_id' => $user->id,
                'views' => rand(50, 200),
                'likes' => rand(10, 50),
                'replies_count' => 3,
                'is_pinned' => true,
                'created_at' => now()->subDays(15),
            ],
            [
                'title' => 'Bayi 9 bulan belum tumbuh gigi, normalkah?',
                'slug' => Str::slug('Bayi 9 bulan belum tumbuh gigi, normalkah?'),
                'content' => 'Anak saya sudah 9 bulan tapi belum ada tanda-tanda tumbuh gigi. Teman-teman seumurannya sudah pada tumbuh gigi. Apakah ini wajar? Haruskah saya konsultasi ke dokter? Ada yang punya pengalaman serupa?',
                'category' => 'Perkembangan',
                'user_id' => $user->id,
                'views' => rand(80, 250),
                'likes' => rand(15, 60),
                'replies_count' => 5,
                'created_at' => now()->subDays(12),
            ],
            [
                'title' => 'Tips mengatasi morning sickness yang parah',
                'slug' => Str::slug('Tips mengatasi morning sickness yang parah'),
                'content' => 'Saya hamil 8 minggu dan mengalami morning sickness yang sangat parah. Mual dan muntah hampir sepanjang hari. Sudah coba makan sedikit-sedikit tapi tetap mual. Ada yang punya tips ampuh? Makanan atau minuman apa yang bisa membantu?',
                'category' => 'Kehamilan',
                'user_id' => $user->id,
                'views' => rand(100, 300),
                'likes' => rand(20, 70),
                'replies_count' => 4,
                'created_at' => now()->subDays(10),
            ],
            [
                'title' => 'Bayi rewel saat malam hari, bagaimana mengatasinya?',
                'slug' => Str::slug('Bayi rewel saat malam hari, bagaimana mengatasinya?'),
                'content' => 'Bayi saya usia 4 bulan sering rewel di malam hari. Siang tidur nyenyak tapi begitu malam tiba suka nangis-nangis. Sudah coba ganti popok, kasih ASI, digendong tetap rewel. Apakah ini fase normal? Bagaimana cara mengatasinya?',
                'category' => 'Perkembangan',
                'user_id' => $user->id,
                'views' => rand(60, 180),
                'likes' => rand(12, 45),
                'replies_count' => 2,
                'created_at' => now()->subDays(7),
            ],
            [
                'title' => 'Bolehkah memberikan air putih pada bayi 6 bulan?',
                'slug' => Str::slug('Bolehkah memberikan air putih pada bayi 6 bulan?'),
                'content' => 'Bayi saya baru mulai MPASI usia 6 bulan. Saya dengar ada yang bilang boleh kasih air putih ada yang tidak. Sebenarnya kapan waktu yang tepat memberikan air putih untuk bayi? Dan berapa banyak yang diperbolehkan?',
                'category' => 'MPASI',
                'user_id' => $user->id,
                'views' => rand(90, 220),
                'likes' => rand(18, 55),
                'replies_count' => 4,
                'created_at' => now()->subDays(5),
            ],
            [
                'title' => 'Vaksin yang wajib diberikan pada bayi 0-12 bulan',
                'slug' => Str::slug('Vaksin yang wajib diberikan pada bayi 0-12 bulan'),
                'content' => 'Mohon info vaksin apa saja yang wajib diberikan untuk bayi dari lahir sampai usia 12 bulan? Saya ingin memastikan anak saya mendapat vaksinasi lengkap sesuai jadwal. Ada yang punya list lengkapnya?',
                'category' => 'Kesehatan',
                'user_id' => $user->id,
                'views' => rand(120, 280),
                'likes' => rand(25, 65),
                'replies_count' => 3,
                'is_pinned' => true,
                'created_at' => now()->subDays(3),
            ],
        ];

        foreach ($discussions as $discussionData) {
            $discussion = Discussion::create($discussionData);

            // Tambahkan sample replies yang relevan
            $repliesByDiscussion = [
                'Bagaimana cara mengenalkan MPASI pertama kali?' => [
                    'Hai! Saya mulai dengan pure alpukat karena teksturnya lembut dan mudah dicerna. Setelah 3 hari baru ganti ke pure pisang. Untuk jadwal, saya kasih 1-2 sendok makan di pagi hari dulu, nanti ditambah porsinya secara bertahap.',
                    'Sebaiknya dimulai dari sayuran dulu seperti pure wortel atau labu, baru buah. Kalau mulai dari buah takutnya nanti bayi lebih suka rasa manis dan menolak sayuran. Untuk jadwal bisa 2x sehari pagi dan siang.',
                    'Jangan lupa perhatikan reaksi alergi ya! Setiap kali kenalkan makanan baru, tunggu 3-5 hari sebelum kasih makanan lain. Saya dulu bikin catatan makanan apa saja yang sudah dikasih.',
                ],
                'Bayi 9 bulan belum tumbuh gigi, normalkah?' => [
                    'Wajar kok! Anak saya malah baru tumbuh gigi pertama di usia 11 bulan. Setiap bayi punya timeline sendiri. Yang penting pertumbuhan dan perkembangan lainnya normal.',
                    'Anak teman saya ada yang sampai 13 bulan baru tumbuh gigi dan sekarang sudah 3 tahun giginya normal semua. Tapi kalau khawatir boleh konsultasi ke dokter gigi anak untuk memastikan.',
                    'Dokter saya bilang tumbuh gigi bisa sampai usia 15 bulan masih normal. Faktor genetik juga berpengaruh lho, coba tanya orangtua dulu kapan tumbuh gigi.',
                    'Saya saranin tetap kasih makanan yang perlu dikunyah seperti biskuit bayi atau buah potong kecil untuk stimulasi gusi.',
                    'Kalau khawatir coba periksa ke dokter anak, biasanya mereka bisa kasih vitamin kalsium kalau memang diperlukan.',
                ],
                'Tips mengatasi morning sickness yang parah' => [
                    'Coba makan biskuit tawar atau roti kering begitu bangun tidur, sebelum bangun dari tempat tidur. Ini membantu banget untuk saya!',
                    'Jahe hangat atau permen jahe ampuh lho! Saya dulu rutin minum air jahe hangat setiap pagi. Hindari juga makanan berminyak dan pedas.',
                    'Makan dalam porsi kecil tapi sering, jangan sampai perut kosong. Saya dulu makan tiap 2-3 jam sekali walaupun cuma sedikit. Dan jangan lupa minum air putih yang cukup.',
                    'Vitamin B6 bisa membantu mengurangi mual. Tapi konsultasi dulu ke dokter kandungan ya sebelum konsumsi suplemen apapun. Kalau terlalu parah sampai dehidrasi sebaiknya langsung ke dokter.',
                ],
                'Bayi rewel saat malam hari, bagaimana mengatasinya?' => [
                    'Coba cek apakah bayi kedinginan atau kepanasan. Pastikan suhu ruangan nyaman sekitar 24-26 derajat. Anak saya dulu juga gitu, ternyata kedinginan.',
                    'Bisa jadi lagi growth spurt atau leap jadi butuh lebih banyak ASI/sufor di malam hari. Coba tingkatkan frekuensi menyusui malam hari. Biasanya fase ini lewat dalam 1-2 minggu.',
                ],
                'Bolehkah memberikan air putih pada bayi 6 bulan?' => [
                    'Boleh kok! Setelah mulai MPASI, bayi boleh dikasih air putih. Tapi jangan terlalu banyak ya, cukup 30-60ml per hari aja. Prioritas tetap ASI/sufor.',
                    'Dokter anak saya bilang boleh dikasih air putih sedikit-sedikit setelah makan MPASI untuk membersihkan mulut. Tapi pastikan airnya matang dan bersih.',
                    'Iya boleh, tapi jangan sampai kenyang air putih ya karena nutrisi utamanya tetap dari ASI/sufor dan MPASI. Air putih hanya sebagai tambahan saja.',
                    'Saya kasih air putih pakai sendok atau gelas trainer, jangan botol dot. Biar sekalian belajar minum dari gelas.',
                ],
                'Vaksin yang wajib diberikan pada bayi 0-12 bulan' => [
                    'Vaksin wajib dari pemerintah: BCG (0-2 bulan), Hepatitis B (lahir, 2, 4 bulan), Polio (lahir, 2, 3, 4 bulan), DPT (2, 3, 4 bulan), Campak (9 bulan). Ini yang gratis di Puskesmas.',
                    'Selain vaksin wajib, ada juga vaksin tambahan yang direkomendasikan seperti PCV, Rotavirus, dan Influenza. Tapi ini berbayar ya. Konsultasi ke dokter anak untuk jadwal lengkapnya.',
                    'Jangan lupa bawa buku KIA (Kesehatan Ibu dan Anak) setiap imunisasi supaya tercatat lengkap. Sangat penting untuk pendaftaran sekolah nanti.',
                ],
            ];

            if (isset($repliesByDiscussion[$discussionData['title']])) {
                $replies = $repliesByDiscussion[$discussionData['title']];
                $replyCount = min($discussionData['replies_count'], count($replies));
                
                for ($i = 0; $i < $replyCount; $i++) {
                    DiscussionReply::create([
                        'discussion_id' => $discussion->id,
                        'user_id' => $user->id,
                        'content' => $replies[$i],
                        'likes' => rand(5, 25),
                        'created_at' => now()->subDays(rand(1, 10)),
                    ]);
                }
            }
        }
    }
}
