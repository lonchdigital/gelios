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
        Schema::create('doctor_category_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_category_id')->nullable()->constrained('doctor_categories')->cascadeOnDelete();
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
        Schema::dropIfExists('doctor_category_translations');
    }
};