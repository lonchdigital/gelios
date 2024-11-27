<?php

namespace App\Services\Admin\Surgery;

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

    public function saveBlock(PageBlock $block, array $data, array $descriptions, array $titles = [])
    {
        $block->page_id = $data['page_id'];
        $block->block = 'static_block';
        $block->key = 'content';
        $block->save();

        foreach ($descriptions as $locale => $description) {
            PageBlockTranslation::updateOrCreate(
                [
                    'locale' => $locale,
                    'page_block_id' => $block->id,
                ],
                [
                    'description' => $description,
                    'title' => $titles[$locale],
                ]
            );
        }

        return $block;
    }
}
