<?php

namespace App\Services\Admin\Article;

use App\Models\ArticleSlider;
use App\Models\ArticleSliderTranslation;
use App\Models\PageBlock;
use App\Models\PageBlockTranslation;

class SliderService
{
    public function getTranslations(ArticleSlider $slide)
    {
        return ArticleSliderTranslation::where('article_slider_id', $slide->id)
            ->get()
            ->keyBy('locale');
    }

    public function saveSlider(ArticleSlider $slide, array $data, array $descriptions)
    {
        $slide->article_id = $data['article_id'];
        $slide->sort = $data['sort'];
        $slide->save();

        foreach ($descriptions as $locale => $description) {
            ArticleSliderTranslation::updateOrCreate(
                [
                    'locale' => $locale,
                    'article_slider_id' => $slide->id,
                ],
                $descriptions[$locale]
            );
        }

        return $slide;
    }

    public function updatePosition(ArticleSlider $slide, $val)
    {
        $currentSort = $slide->sort;
        $newSort = $currentSort + $val;

        ArticleSlider::where('sort', $newSort)->first()->update([
            'sort' => $currentSort,
        ]);

        $slide->update([
            'sort' => $newSort,
        ]);
    }
}
