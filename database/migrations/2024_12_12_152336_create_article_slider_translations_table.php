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
        Schema::create('article_slider_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_slider_id')->nullable()->constrained('article_sliders')->cascadeOnDelete();
            $table->string('locale', 10)->index();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_slider_translations');
    }
};