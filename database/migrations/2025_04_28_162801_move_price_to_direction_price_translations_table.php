<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\DirectionPriceTranslation;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


return new class extends Migration
{
    public function up(): void
    {
        Schema::table('direction_price_translations', function (Blueprint $table) {
            if (!Schema::hasColumn('direction_price_translations', 'price')) {
                $table->string('price')->nullable()->after('service');
            }
        });

        $directionPrices = DB::table('direction_prices')
            ->select('id', 'price')
            ->get();

        $oldTranslations = DB::table('direction_price_translations')
            ->select('direction_price_id', 'locale', 'service')
            ->get()
            ->groupBy('direction_price_id');

        DB::table('direction_price_translations')->truncate();

        $insertData = [];

        foreach ($directionPrices as $directionPrice) {
            foreach (config('translatable.locales') as $locale) {
                $service = null;

                if (isset($oldTranslations[$directionPrice->id])) {
                    $serviceRow = $oldTranslations[$directionPrice->id]->firstWhere('locale', $locale);
                    if ($serviceRow) {
                        $service = $serviceRow->service;
                    }
                }

                $insertData[] = [
                    'direction_price_id' => $directionPrice->id,
                    'locale' => $locale,
                    'service' => $service,
                    'price' => (string) ($directionPrice->price ?? '0.00'),
                ];
            }
        }

        if (!empty($insertData)) {
            DB::table('direction_price_translations')->insert($insertData);
        }

        Schema::table('direction_prices', function (Blueprint $table) {
            if (Schema::hasColumn('direction_prices', 'price')) {
                $table->dropColumn('price');
            }
        });
    }

    public function down(): void
    {
        Schema::table('direction_prices', function (Blueprint $table) {
            if (!Schema::hasColumn('direction_prices', 'price')) {
                $table->decimal('price', 10, 2)->nullable();
            }
        });

        $translations = DB::table('direction_price_translations')
            ->where('locale', 'ua')
            ->select('direction_price_id', 'price')
            ->get();

        foreach ($translations as $translation) {
            DB::table('direction_prices')
                ->where('id', $translation->direction_price_id)
                ->update([
                    'price' => (float) $translation->price,
                ]);
        }

        Schema::table('direction_price_translations', function (Blueprint $table) {
            if (Schema::hasColumn('direction_price_translations', 'price')) {
                $table->dropColumn('price');
            }
        });
    }
};