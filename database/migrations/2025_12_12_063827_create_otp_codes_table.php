<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('otp_codes', function (Blueprint $table) {
            $table->id();
            $table->string('identifier'); // email (atau nanti nomor hp)
            $table->string('channel')->default('email'); // email/sms
            $table->string('otp_hash');
            $table->timestamp('expires_at');
            $table->timestamp('used_at')->nullable();
            $table->unsignedTinyInteger('attempts')->default(0);
            $table->timestamps();

            $table->index(['identifier', 'channel']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('otp_codes');
    }
};