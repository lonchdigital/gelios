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
        Schema::create('direction_text_blocks', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('direction_id');
            $table->foreign('direction_id')->references('id')->on('directions')->onDelete('cascade');

            $table->unsignedTinyInteger('number')->default(1);
            $table->boolean('is_reverse')->default(false); 
            $table->boolean('is_image')->default(true); 
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direction_text_blocks');
    }
};
