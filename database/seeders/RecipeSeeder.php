<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Support\Str;

class RecipeSeeder extends Seeder
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

        $recipes = [
            [
                'title' => 'Pure Alpukat untuk Bayi',
                'slug' => Str::slug('Pure Alpukat untuk Bayi'),
                'description' => 'Pure alpukat lembut dan creamy, kaya akan lemak sehat dan nutrisi penting untuk perkembangan otak bayi.',
                'ingredients' => "1 buah alpukat matang\n50 ml ASI atau susu formula",
                'instructions' => "Belah alpukat dan ambil daging buahnya\nHaluskan alpukat dengan sendok atau blender\nTambahkan ASI/susu formula sedikit demi sedikit hingga mencapai tekstur yang diinginkan\nSajikan segera",
                'age_range' => '6-8 bulan',
                'category' => 'Pure',
                'cooking_time' => 5,
                'servings' => 1,
                'difficulty' => 'Mudah',
                'user_id' => $user->id,
                'is_published' => true,
                'published_at' => now()->subDays(30),
                'views' => rand(100, 500),
                'likes' => rand(20, 80),
            ],
            [
                'title' => 'Bubur Beras Merah Ayam',
                'slug' => Str::slug('Bubur Beras Merah Ayam'),
                'description' => 'Bubur beras merah yang kaya serat dengan tambahan protein dari ayam kampung untuk pertumbuhan optimal.',
                'ingredients' => "50 gram beras merah, cuci bersih\n50 gram dada ayam, potong kecil\n300 ml air\n1 lembar daun salam\n1 batang seledri",
                'instructions' => "Rebus beras merah dengan air dan daun salam hingga menjadi bubur\nTambahkan potongan ayam, masak hingga ayam matang\nMasukkan seledri yang sudah dicincang halus\nMasak hingga bubur mengental dan semua bahan matang sempurna\nBlender atau haluskan sesuai tekstur yang diinginkan\nSajikan hangat",
                'age_range' => '9-11 bulan',
                'category' => 'Bubur',
                'cooking_time' => 30,
                'servings' => 2,
                'difficulty' => 'Sedang',
                'user_id' => $user->id,
                'is_published' => true,
                'published_at' => now()->subDays(25),
                'views' => rand(150, 600),
                'likes' => rand(30, 100),
            ],
            [
                'title' => 'Finger Food Pisang Oat',
                'slug' => Str::slug('Finger Food Pisang Oat'),
                'description' => 'Camilan sehat berbentuk stik yang mudah digenggam, sempurna untuk melatih keterampilan motorik halus bayi.',
                'ingredients' => "2 buah pisang matang\n100 gram oat\n1 butir telur\n2 sdm minyak kelapa\nSejumput kayu manis",
                'instructions' => "Panaskan oven 180°C\nHaluskan pisang dengan garpu\nCampur pisang, oat, telur, minyak kelapa, dan kayu manis\nAduk hingga rata dan adonan mengental\nBentuk adonan menjadi stik atau bulat kecil\nTaruh di loyang yang sudah dialasi kertas roti\nPanggang selama 15-20 menit hingga kecoklatan\nBiarkan dingin sebelum disajikan",
                'age_range' => '9-11 bulan',
                'category' => 'Finger Food',
                'cooking_time' => 25,
                'servings' => 10,
                'difficulty' => 'Mudah',
                'user_id' => $user->id,
                'is_published' => true,
                'published_at' => now()->subDays(20),
                'views' => rand(200, 700),
                'likes' => rand(50, 120),
            ],
            [
                'title' => 'Pure Labu Kuning Keju',
                'slug' => Str::slug('Pure Labu Kuning Keju'),
                'description' => 'Labu kuning manis yang diperkaya dengan keju untuk tambahan kalsium dan rasa yang lezat.',
                'ingredients' => "100 gram labu kuning, potong dadu\n20 gram keju cheddar parut\n50 ml ASI atau susu formula",
                'instructions' => "Kukus labu kuning hingga empuk (sekitar 10 menit)\nHaluskan labu dengan blender atau food processor\nTambahkan keju parut dan ASI/susu formula\nBlender lagi hingga tekstur halus dan creamy\nSajikan segera selagi hangat",
                'age_range' => '6-8 bulan',
                'category' => 'Pure',
                'cooking_time' => 15,
                'servings' => 1,
                'difficulty' => 'Mudah',
                'user_id' => $user->id,
                'is_published' => true,
                'published_at' => now()->subDays(15),
                'views' => rand(120, 450),
                'likes' => rand(25, 75),
            ],
            [
                'title' => 'Nasi Tim Ikan Salmon',
                'slug' => Str::slug('Nasi Tim Ikan Salmon'),
                'description' => 'Nasi tim lembut dengan salmon kaya omega-3 untuk mendukung perkembangan otak dan mata bayi.',
                'ingredients' => "50 gram beras putih\n30 gram fillet salmon segar\n1 sdm wortel parut\n1 sdm bayam cincang\n250 ml air kaldu ayam\n1 siung bawang putih, cincang halus",
                'instructions' => "Cuci bersih beras dan tiriskan\nCampurkan beras, salmon yang sudah dipotong kecil, wortel, bayam, dan bawang putih\nTuang air kaldu\nTim dalam panci tim selama 30-40 menit hingga matang dan lembut\nAduk rata, cek tekstur (haluskan lebih lanjut jika diperlukan)\nSajikan hangat",
                'age_range' => '9-11 bulan',
                'category' => 'Bubur',
                'cooking_time' => 45,
                'servings' => 2,
                'difficulty' => 'Sedang',
                'user_id' => $user->id,
                'is_published' => true,
                'published_at' => now()->subDays(10),
                'views' => rand(180, 550),
                'likes' => rand(40, 95),
            ],
            [
                'title' => 'Pancake Pisang Mini',
                'slug' => Str::slug('Pancake Pisang Mini'),
                'description' => 'Pancake mini lembut tanpa gula tambahan, manis alami dari pisang, cocok untuk camilan sehat.',
                'ingredients' => "1 buah pisang matang\n1 butir telur\n50 gram tepung terigu\n50 ml susu UHT\n1 sdm mentega leleh\nSejumput baking powder",
                'instructions' => "Haluskan pisang dengan garpu hingga lembut\nKocok lepas telur, campur dengan pisang\nTambahkan tepung terigu, susu, baking powder, dan mentega\nAduk hingga adonan rata dan tidak bergerindil\nPanaskan teflon anti lengket dengan api kecil\nTuang 1 sendok makan adonan, buat bulat kecil\nMasak hingga muncul gelembung, balik dan masak sisi lain\nAngkat dan sajikan hangat",
                'age_range' => '12-24 bulan',
                'category' => 'Snack',
                'cooking_time' => 20,
                'servings' => 8,
                'difficulty' => 'Mudah',
                'user_id' => $user->id,
                'is_published' => true,
                'published_at' => now()->subDays(7),
                'views' => rand(250, 800),
                'likes' => rand(60, 150),
            ],
            [
                'title' => 'Bubur Brokoli Kentang Daging',
                'slug' => Str::slug('Bubur Brokoli Kentang Daging'),
                'description' => 'Kombinasi sayuran hijau dan daging sapi untuk asupan zat besi dan vitamin lengkap.',
                'ingredients' => "3 kuntum brokoli kecil\n1 buah kentang ukuran sedang, potong dadu\n50 gram daging sapi giling\n1 siung bawang putih\n300 ml air kaldu\n1 sdm minyak zaitun",
                'instructions' => "Tumis bawang putih dengan minyak zaitun hingga harum\nMasukkan daging giling, aduk hingga berubah warna\nTambahkan kentang dan air kaldu, masak hingga kentang empuk\nMasukkan brokoli, masak 5 menit lebih\nBlender semua bahan hingga halus atau sesuai tekstur yang diinginkan\nTambahkan sedikit air jika terlalu kental\nSajikan hangat",
                'age_range' => '9-11 bulan',
                'category' => 'Bubur',
                'cooking_time' => 25,
                'servings' => 2,
                'difficulty' => 'Sedang',
                'user_id' => $user->id,
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'views' => rand(140, 500),
                'likes' => rand(35, 85),
            ],
            [
                'title' => 'Pure Ubi Ungu',
                'slug' => Str::slug('Pure Ubi Ungu'),
                'description' => 'Pure ubi ungu yang manis alami, kaya antioksidan dan serat untuk pencernaan sehat.',
                'ingredients' => "100 gram ubi ungu, kupas dan potong dadu\n60 ml ASI atau susu formula\n1 sdt mentega (opsional)",
                'instructions' => "Kukus ubi ungu hingga empuk (sekitar 15 menit)\nHaluskan ubi dengan garpu atau blender\nTambahkan ASI/susu formula sedikit demi sedikit sambil terus diaduk\nTambahkan mentega untuk rasa lebih creamy (opsional)\nAduk hingga tekstur halus dan lembut\nSajikan hangat",
                'age_range' => '6-8 bulan',
                'category' => 'Pure',
                'cooking_time' => 20,
                'servings' => 1,
                'difficulty' => 'Mudah',
                'user_id' => $user->id,
                'is_published' => true,
                'published_at' => now()->subDays(3),
                'views' => rand(100, 400),
                'likes' => rand(20, 70),
            ],
        ];

        foreach ($recipes as $recipe) {
            Recipe::create($recipe);
        }
    }
}
