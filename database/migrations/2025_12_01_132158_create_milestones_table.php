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
        Schema::create('milestones', function (Blueprint $table) {
            $table->id();
            $table->string('category'); // Motorik Kasar, Motorik Halus, Kognitif, Bahasa, Sosial-Emosional
            $table->string('age_range'); // 0-3 bulan, 4-6 bulan, dst
            $table->integer('min_age_months'); // Usia minimum dalam bulan
            $table->integer('max_age_months'); // Usia maksimum dalam bulan
            $table->string('title');
            $table->text('description');
            $table->text('tips')->nullable(); // Tips untuk orang tua
            $table->timestamps();
        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milestones');
    }
};
