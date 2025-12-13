<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('device_tokens', function (Blueprint $table) {
            // Tambah kolom jika belum ada (untuk jaga-jaga)
            if (!Schema::hasColumn('device_tokens', 'platform')) {
                $table->string('platform', 20)->nullable()->after('token');
            }

            if (!Schema::hasColumn('device_tokens', 'last_seen_at')) {
                $table->timestamp('last_seen_at')->nullable()->after('platform');
            }

            // Pastikan ada relasi user_id (kalau belum ada, tambahkan)
            // NOTE: kalau user_id sudah ada, jangan ditambah
        });
    }

    public function down(): void
    {
        Schema::table('device_tokens', function (Blueprint $table) {
            if (Schema::hasColumn('device_tokens', 'platform')) {
                $table->dropColumn('platform');
            }
            if (Schema::hasColumn('device_tokens', 'last_seen_at')) {
                $table->dropColumn('last_seen_at');
            }
        });
    }
};
