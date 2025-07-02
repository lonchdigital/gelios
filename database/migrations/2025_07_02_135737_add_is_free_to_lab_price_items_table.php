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
        Schema::table('lab_price_items', function (Blueprint $table) {
            $table->boolean('is_free')->after('lab_price_category_id')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lab_price_items', function (Blueprint $table) {
            $table->dropColumn('is_free');
        });
    }
};
