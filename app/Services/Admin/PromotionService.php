<?php

namespace App\Services\Admin;

use App\Models\PromotionTranslation;

class PromotionService
{
    public function getTranslation($promotionId, $locale)
    {
        return PromotionTranslation::where('locale', $locale)
            ->where('promotion_id', $promotionId)
            ->first();
    }

    public function getTranslationsForLocales($promotionId, array $locales)
    {
        $translations = [];

        foreach ($locales as $locale) {
            $translation = $this->getTranslation($promotionId, $locale);

            $translations[$locale] = [
                'title' => $translation->title ?? '',
                'price' => $translation->price ?? '',
                'description' => $translation->description ?? '',
            ];
        }

        return $translations;
    }

    public function saveTranslations($promotionId, array $translations)
    {
        foreach ($translations as $locale => $data) {
            PromotionTranslation::updateOrCreate(
                [
                    'locale' => $locale,
                    'promotion_id' => $promotionId,
                ],
                [
                    'title' => $data['title'],
                    'price' => $data['price'],
                    'description' => $data['description'],
                ]
            );
        }
    }
}
