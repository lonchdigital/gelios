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
        Schema::create('article_block_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_block_id')->constrained('article_blocks')->cascadeOnDelete();
            $table->string('locale', 10)->index();
            $table->string('first_title')->nullable();
            $table->text('first_content')->nullable();
            $table->string('second_title')->nullable();
            $table->text('second_content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_block_translations');
    }
};
