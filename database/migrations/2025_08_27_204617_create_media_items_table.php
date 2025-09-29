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
        Schema::create('media_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('media_category_id')->constrained()->onDelete('cascade');
            $table->string('type'); // 'youtube_channel', 'youtube_video', 'instagram_account', 'instagram_embed'
            $table->string('title');
            $table->text('content'); // URL, embed code, or other content
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable(); // thumbnail image URL
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_items');
    }
};
