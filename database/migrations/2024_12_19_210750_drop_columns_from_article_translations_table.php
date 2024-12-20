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
        Schema::table('article_translations', function (Blueprint $table) {
            $table->dropColumn('author_name');
            $table->dropColumn('author_specialization');
            $table->dropColumn('author_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('article_translations', function (Blueprint $table) {
            $table->string('author_name')->after('description')->nullable();
            $table->string('author_specialization')->after('author_name')->nullable();
            $table->text('author_description')->after('author_specialization')->nullable();
        });
    }
};
