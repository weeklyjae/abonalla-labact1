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
        Schema::create('media_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Personal", "Editing", "Photography"
            $table->string('slug')->unique(); // e.g., "personal", "editing", "photography"
            $table->text('description')->nullable();
            $table->string('icon')->nullable(); // emoji or icon class
            $table->string('color')->nullable(); // hex color for styling
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
        Schema::dropIfExists('media_categories');
    }
};
