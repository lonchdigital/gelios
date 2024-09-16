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
        Schema::create('laboratory_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laboratory_id')->nullable()->constrained('laboratories')->cascadeOnDelete();
            $table->string('locale', 10)->index();
            $table->string('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratory_translations');
    }
};
