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
        Schema::create('vacancy_apps', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->text('vacancy')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancy_apps');
    }
};
