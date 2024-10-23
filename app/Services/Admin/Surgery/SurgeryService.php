<?php

namespace App\Services\Admin\Surgery;

use App\Models\PageBlockTranslation;

class SurgeryService
{
    public function getTranslations($blockId)
    {
        return PageBlockTranslation::where('page_block_id', $blockId)
            ->whereIn('locale', ['ua', 'en', 'ru'])
            ->get()
            ->keyBy('locale');
    }

    public function saveTranslations($blockId, $translations)
    {
        foreach ($translations as $locale => $data) {
            PageBlockTranslation::updateOrCreate(
                ['page_block_id' => $blockId, 'locale' => $locale],
                $data
            );
        }
    }
}
