<?php

namespace App\Services\Admin\Article;

use App\Models\Article;
use App\Models\ArticleBlock;
use App\Models\ArticleTranslation;

class ArticleService
{
    public function getTranslations($articleId)
    {
        return ArticleTranslation::where('article_id', $articleId)->get()->keyBy('locale');
    }

    public function saveTranslations(
        $articleId,
        $titles,
        $descriptions,
        $seoTitles,
        $seoDescriptions
        )
    {
        $locales = ['ua', 'en', 'ru'];

        foreach ($locales as $locale) {
            ArticleTranslation::updateOrCreate(
                [
                    'locale' => $locale,
                    'article_id' => $articleId,
                ],
                [
                    'title' => $titles[$locale],
                    'description' => $descriptions[$locale],
                    'seo_title' =>  $seoTitles[$locale],
                    'seo_description' => $seoDescriptions[$locale],
                ]
            );
        }
    }

    public function updatePosition(ArticleBlock $block, $val)
    {
        $currentSort = $block->sort;
        $newSort = $currentSort + $val;

        ArticleBlock::where('sort', $newSort)->first()->update([
            'sort' => $currentSort,
        ]);

        $block->update([
            'sort' => $newSort,
        ]);
    }

    public function changeIsShowInSurgeryPage($id)
    {
        $article = Article::find($id);

        $article->update([
            'is_show_in_surgery_page' => !$article->is_show_in_surgery_page
        ]);
    }
}
