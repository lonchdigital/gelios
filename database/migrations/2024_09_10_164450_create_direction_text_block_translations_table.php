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
        Schema::create('direction_text_block_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('direction_text_block_id')->unsigned();
            $table->foreign('direction_text_block_id', 'dtextblock_translations_foreign')
            ->references('id')
            ->on('direction_text_blocks')
            ->onDelete('cascade');

            $table->string('locale', 10)->index();
            $table->text('text_one')->nullable();
            $table->text('text_two')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direction_text_block_translations');
    }
};
