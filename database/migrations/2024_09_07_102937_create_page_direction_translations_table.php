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
        Schema::create('page_direction_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('page_direction_id')->unsigned();
            $table->foreign('page_direction_id')->references('id')->on('page_directions')->onDelete('cascade');
            $table->string('locale', 10)->index();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('text')->nullable();

            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_direction_translations');
    }
};
