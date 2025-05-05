<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('direction_price_translations', function (Blueprint $table) {
            $table->text('service')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('direction_price_translations', function (Blueprint $table) {
            $table->string('service')->nullable()->change();
        });
    }
};