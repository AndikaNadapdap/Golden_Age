<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('ingredients'); // JSON or text
            $table->text('instructions'); // JSON or text
            $table->string('age_range'); // 6-8 bulan, 9-11 bulan, 12-24 bulan
            $table->string('category')->default('Bubur'); // Bubur, Pure, Finger Food, Snack
            $table->integer('cooking_time')->nullable(); // dalam menit
            $table->integer('servings')->default(1);
            $table->string('difficulty')->default('Mudah'); // Mudah, Sedang, Sulit
            $table->string('image')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
<<<<<<< HEAD
};
=======
};  
>>>>>>> 06c3d90f5d1bf6bf4289c9def1dacefbaf3aa2e9
