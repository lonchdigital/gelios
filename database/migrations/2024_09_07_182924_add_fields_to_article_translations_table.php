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
            $table->foreignId('article_id')->after('id')->constrained('articles')->cascadeOnDelete();
            $table->string('locale', 10)->after('article_id')->index();
            $table->string('title')->after('locale')->nullable();
            $table->text('description')->after('title_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('article_translations', function (Blueprint $table) {
            $table->dropForeign(['article_id']);
            $table->dropColumn('article_id');
            $table->dropColumn('locale');
            $table->dropColumn('title');
            $table->dropColumn('description');
        });
    }
};
