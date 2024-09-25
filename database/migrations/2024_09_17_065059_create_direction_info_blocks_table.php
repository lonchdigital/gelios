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
        Schema::create('direction_info_blocks', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('direction_id');
            $table->foreign('direction_id')->references('id')->on('directions')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direction_info_blocks');
    }
};
