<?php

namespace App\Services\Admin\Surgery;

use App\Models\SurgeryBlock;
use App\Models\SurgeryBlockTranslation;

class DirectionBlockService
{
    public function getTranslations(SurgeryBlock $block)
    {
        $translations = SurgeryBlockTranslation::where('surgery_block_id', $block->id)
            ->get()
            ->keyBy('locale');

        return [
            'ua' => $translations['ua']->description ?? '',
            'en' => $translations['en']->description ?? '',
            'ru' => $translations['ru']->description ?? '',
        ];
    }

    public function saveSurgeryBlock($block, $surgeryId, $descriptions)
    {
        $block->surgery_id = $surgeryId;
        $block->save();

        $locales = ['ua', 'en', 'ru'];
        foreach ($locales as $locale) {
            SurgeryBlockTranslation::updateOrCreate(
                [
                    'locale' => $locale,
                    'surgery_block_id' => $block->id,
                ],
                [
                    'description' => $descriptions[$locale],
                ]
            );
        }
    }
}

