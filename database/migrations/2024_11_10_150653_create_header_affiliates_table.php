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
        Schema::create('header_affiliates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('header_city_id')->nullable()->constrained('header_cities')->cascadeOnDelete();
            $table->string('first_phone')->nullable();
            $table->string('second_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('hours')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('header_affiliates');
    }
};
