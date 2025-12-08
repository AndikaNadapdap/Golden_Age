<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stimulations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('category'); // Motorik Kasar, Motorik Halus, Kognitif, Bahasa, Sosial-Emosional
            $table->string('age_range'); // 0-3 bulan, 4-6 bulan, 7-9 bulan, dst
            $table->text('materials')->nullable(); // Alat dan bahan yang dibutuhkan
            $table->text('instructions'); // Langkah-langkah permainan
            $table->text('benefits'); // Manfaat stimulasi
            $table->string('duration')->nullable(); // Durasi permainan
            $table->string('image')->nullable();
            $table->integer('likes')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stimulations');
    }
};  
