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
        Schema::create('brief_block_translations', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('brief_block_id')->unsigned();
            $table->foreign('brief_block_id')
            ->references('id')
            ->on('brief_blocks')
            ->onDelete('cascade');

            $table->string('locale', 10)->index();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brief_block_translations');
    }
};
