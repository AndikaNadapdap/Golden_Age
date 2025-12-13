<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('child_id')->nullable()->constrained('children')->nullOnDelete();
            $table->foreignId('milestone_id')->nullable()->constrained('milestones')->nullOnDelete();

            $table->string('title', 150);
            $table->text('body')->nullable();

            $table->timestamp('scheduled_at');
            $table->timestamp('sent_at')->nullable();

            $table->string('status', 20)->default('pending'); // pending/sent/failed
            $table->text('error_message')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'status', 'scheduled_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
