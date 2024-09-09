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
        Schema::create('direction_translations', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('direction_id')->unsigned();
            $table->foreign('direction_id')->references('id')->on('directions')->onDelete('cascade');

            $table->string('locale', 10)->index();
            $table->string('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direction_translations');
    }
};
