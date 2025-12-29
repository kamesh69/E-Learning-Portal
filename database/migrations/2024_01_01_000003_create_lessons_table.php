<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_section_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->enum('type', ['video', 'text', 'quiz'])->default('video');
            $table->string('video_url')->nullable(); // Could be youtube or local path
            $table->text('content')->nullable(); // For text lessons
            $table->integer('duration_minutes')->nullable();
            $table->boolean('is_free_preview')->default(false);
            $table->integer('order_index')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
