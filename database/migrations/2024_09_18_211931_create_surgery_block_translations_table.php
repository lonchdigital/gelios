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
        Schema::create('surgery_block_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surgery_block_id')->constrained('surgery_blocks')->cascadeOnDelete();
            $table->string('locale', 10)->index();
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
        Schema::dropIfExists('surgery_block_translations');
    }
};