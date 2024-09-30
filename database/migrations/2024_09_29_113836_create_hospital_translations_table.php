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
        Schema::create('hospital_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('hospital_id')->unsigned();
            $table->foreign('hospital_id')
            ->references('id')
            ->on('hospitals')
            ->onDelete('cascade');

            $table->string('locale', 10)->index();
            $table->string('name')->nullable();
            $table->text('text_one')->nullable();
            $table->text('text_two')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospital_translations');
    }
};
