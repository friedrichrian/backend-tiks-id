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
        Schema::create('genre_movie', function (Blueprint $table) {
            $table->foreignId('movie_id')->constrained('movie')->cascadeOnDelete();
            $table->foreignId('genre_id')->constrained('genre')->cascadeOnDelete();
            $table->primary(['genre_id', 'movie_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('genre_movie', function (Blueprint $table) {
            $table->dropForeign(['genre_id']);
            $table->dropForeign(['movie_id']);
        });
        Schema::dropIfExists('genre_movie');
    }
};
