<?php

namespace App\Services\Admin\CheckUp;

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

    public function saveBlock(PageBlock $block, array $data, array $descriptions)
    {
        $block->page_id = $data['page_id'];
        $block->block = 'main';
        $block->key = 'text';
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
