<?php

namespace App\Services\Admin\Laboratory;

use App\Models\PageBlock;
use App\Models\PageBlockTranslation;

class BlockService
{
    public function getTranslations(PageBlock $block)
    {
        return PageBlockTranslation::where('page_block_id', $block->id)
            ->get()
            ->keyBy('locale');
    }

    public function saveSlider(PageBlock $block, array $data, array $descriptions)
    {
        $block->page_id = $data['page_id'];
        $block->url = $data['link'];
        $block->block = $data['block'] ?? '';
        $block->key = $data['key'] ?? '';
        $block->save();

        foreach ($descriptions as $locale => $description) {
            PageBlockTranslation::updateOrCreate(
                [
                    'locale' => $locale,
                    'page_block_id' => $block->id,
                ],
                $descriptions[$locale]
            );
        }

        return $block;
    }
}
