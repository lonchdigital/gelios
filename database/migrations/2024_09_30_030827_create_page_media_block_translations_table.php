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
        Schema::create('page_media_block_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('page_media_block_id')->unsigned();
            $table->foreign('page_media_block_id', 'pmediablock_translations_foreign')
            ->references('id')
            ->on('page_media_blocks')
            ->onDelete('cascade');

            $table->string('locale', 10)->index();
            $table->text('text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_media_block_translations');
    }
};
