<?php

namespace App\Services\Admin\Article;

use App\Models\ArticleCategory;
use App\Models\ArticleCategoryTranslation;

class ArticleCategoryService
{
    public function getTranslation(ArticleCategory $category, string $locale): string
    {
        return ArticleCategoryTranslation::where('locale', $locale)
            ->where('article_category_id', $category->id ?? null)
            ->first()
            ->title ?? '';
    }

    public function saveTranslation(ArticleCategory $category, string $locale, string $title)
    {
        ArticleCategoryTranslation::updateOrCreate([
            'locale' => $locale,
            'article_category_id' => $category->id,
        ], [
            'title' => $title,
        ]);
    }
}
