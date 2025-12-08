<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discussion_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discussion_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('content');
            $table->integer('likes')->default(0);
            $table->boolean('is_best_answer')->default(false);
            $table->timestamps();
            
            $table->index('discussion_id');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discussion_replies');
    }
};
<<<<<<< HEAD
=======
 
>>>>>>> 06c3d90f5d1bf6bf4289c9def1dacefbaf3aa2e9
