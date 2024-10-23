<?php

namespace App\Services\Sitemap;

use App\Models\Article;
use App\Models\Page;
use Illuminate\Database\Eloquent\Collection;

class SitemapPageService
{
    private Collection $pages;
    private Collection $articles;
    private Collection $cars;

    public function __construct()
    {
        $this->pages = Page::whereNotNull('slug')
            ->whereNotIn('slug', ['header', 'footer'])
            ->get();

        $this->articles = Article::whereNotNull('slug')
            ->get();
    }

    /**
     * Отримує всіх URL сторінок.
     *
     * @return array
     */
    final public function getUrls(): array
    {
        return array_unique(array_map([$this, 'formatUrl'], [
            ...$this->getPageUrls(),
            ...$this->getRuPageUrls(),
            ...$this->getArticlesUrls(),
            ...$this->getRuArticlesUrls(),
            ...$this->getEnArticlesUrls(),
            ...$this->getCarsUrls(),
            ...$this->getCarsUrls(),
        ]));
    }

    /**
     * Отримує URL статей.
     *
     * @return array
     */
    private function getArticlesUrls(): array
    {
        return $this->articles->map(function ($article) {
            return 'post/' . $article->slug;
        })->all();
    }

    private function getRuArticlesUrls(): array
    {
        return $this->articles->map(function ($article) {
            return 'ru/post/' . $article->slug;
        })->all();
    }

    private function getEnArticlesUrls(): array
    {
        return $this->articles->map(function ($article) {
            return 'en/post/' . $article->slug;
        })->all();
    }

    /**
     * Отримує URL сторінок.
     *
     * @return array
     */
    private function getPageUrls()
    {
        return $this->pages->map( function ($page) {
            return $page->slug;
        })->all();
    }

    private function getRuPageUrls()
    {
        return $this->pages->map( function ($page) {
            return 'ru/' . $page->slug;
        })->all();
    }

    private function getCarsUrls()
    {
        return $this->cars->map( function ($car) {
            return 'product/' . $car->slug;
        })->all();
    }

    private function getRuCarsUrls()
    {
        return $this->cars->map( function ($car) {
            return 'ru/product/' . $car->slug;
        })->all();
    }

    /**
     * Видаляє подвійні слеші, додає слеш в кінець URL та на початок за умови якщо він не доданий.
     *
     * @param string $url
     * @return string
     */
    private function formatUrl(string $url): string
    {
        $fUrl = trim(trim(preg_replace('/\/+/', '/', $url), '/'));

        if (!str_starts_with($fUrl, '/')) {
            $fUrl = '/' . $fUrl;
        }

        return rtrim($fUrl, '/') . '/';
    }
}
