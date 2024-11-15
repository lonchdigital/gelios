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
        Schema::create('header_city_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('header_city_id')->nullable()->constrained('header_cities')->cascadeOnDelete();
            $table->string('locale', 10)->index();
            $table->string('title')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('header_city_translations');
    }
};
