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
        Schema::create('insurance_company_translations', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('insurance_company_id')->unsigned();
            $table->foreign('insurance_company_id')->references('id')->on('insurance_companies')->onDelete('cascade');

            $table->string('locale', 10)->index();
            $table->string('test')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_company_translations');
    }
};
