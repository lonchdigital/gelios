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
        Schema::create('section_images', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('page_id')->unsigned();
            $table->foreign('page_id')
            ->references('id')
            ->on('pages')
            ->onDelete('cascade');

            $table->string('sort')->nullable();
            $table->string('type')->nullable();
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_images');
    }
};
