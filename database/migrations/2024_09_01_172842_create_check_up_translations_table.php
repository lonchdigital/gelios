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
        Schema::create('check_up_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('check_up_id')->nullable()->constrained('check_ups')->cascadeOnDelete();
            $table->string('locale', 10)->index();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_up_translations');
    }
};
