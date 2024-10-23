<?php

namespace App\Services\Admin\Article;

use App\Models\ArticleBlockTranslation;

class ArticleBlockService
{
    public function getTranslations($articleBlockId)
    {
        return ArticleBlockTranslation::where('article_block_id', $articleBlockId)->get()->keyBy('locale');
    }

    public function saveTranslations($blockId, $locales, $firstTitles, $secondTitles, $firstDescriptions, $secondDescriptions, $type)
    {
        foreach ($locales as $locale) {
            ArticleBlockTranslation::updateOrCreate(
                [
                    'locale' => $locale,
                    'article_block_id' => $blockId,
                ],
                [
                    'first_title' => $firstTitles[$locale],
                    'second_title' => $secondTitles[$locale],
                    'first_content' => $type !== 'twoblocks' ? $firstDescriptions[$locale] : '',
                    'second_content' => $type !== 'twoblocks' ? $secondDescriptions[$locale] : '',
                ]
            );
        }
    }
}
