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
        Schema::create('directions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('page_direction_id')->nullable();
            $table->foreign('page_direction_id')->references('id')->on('page_directions')->onDelete('cascade');

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('sort')->nullable();
            $table->unsignedTinyInteger('template');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('directions');
    }
};
