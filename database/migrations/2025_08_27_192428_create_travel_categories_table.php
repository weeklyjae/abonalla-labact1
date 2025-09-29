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
        Schema::create('travel_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Bangkok Trip", "Paris Adventure"
            $table->text('description')->nullable(); // Short description of the place
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_categories');
    }
};
