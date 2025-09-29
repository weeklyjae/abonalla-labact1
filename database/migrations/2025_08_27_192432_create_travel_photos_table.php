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
        Schema::create('travel_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('travel_category_id')->constrained('travel_categories')->onDelete('cascade');
            $table->string('filename');
            $table->string('original_name');
            $table->string('file_path');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_photos');
    }
};
