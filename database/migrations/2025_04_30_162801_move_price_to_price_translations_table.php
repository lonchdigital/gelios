<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('price_translations', function (Blueprint $table) {
            if (!Schema::hasColumn('price_translations', 'price')) {
                $table->string('price')->nullable()->after('service');
            }
        });

        $prices = DB::table('prices')
            ->select('id', 'price')
            ->get();

        $oldTranslations = DB::table('price_translations')
            ->select('price_id', 'locale', 'service')
            ->get()
            ->groupBy('price_id');

        DB::table('price_translations')->truncate();

        $insertData = [];

        foreach ($prices as $price) {
            foreach (config('translatable.locales') as $locale) {
                $service = null;

                if (isset($oldTranslations[$price->id])) {
                    $row = $oldTranslations[$price->id]->firstWhere('locale', $locale);
                    if ($row) {
                        $service = $row->service;
                    }
                }

                $insertData[] = [
                    'price_id' => $price->id,
                    'locale' => $locale,
                    'service' => $service,
                    'price' => (string) ($price->price ?? '0.00'),
                ];
            }
        }

        if (!empty($insertData)) {
            DB::table('price_translations')->insert($insertData);
        }

        Schema::table('prices', function (Blueprint $table) {
            if (Schema::hasColumn('prices', 'price')) {
                $table->dropColumn('price');
            }
        });
    }

    public function down(): void
    {
        Schema::table('prices', function (Blueprint $table) {
            if (!Schema::hasColumn('prices', 'price')) {
                $table->decimal('price', 10, 2)->nullable();
            }
        });

        $translations = DB::table('price_translations')
            ->where('locale', config('translatable.fallback_locale', 'ua'))
            ->select('price_id', 'price')
            ->get();

        foreach ($translations as $translation) {
            DB::table('prices')
                ->where('id', $translation->price_id)
                ->update([
                    'price' => (float) $translation->price,
                ]);
        }

        Schema::table('price_translations', function (Blueprint $table) {
            if (Schema::hasColumn('price_translations', 'price')) {
                $table->dropColumn('price');
            }
        });
    }
};