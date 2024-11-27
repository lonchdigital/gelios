<?php

namespace App\Services\Sitemap;

use App\Models\Article;
use App\Models\Doctor;
use App\Models\Page;
use Illuminate\Database\Eloquent\Collection;

class SitemapPageService
{
    private Collection $pages;
    private Collection $articles;
    private Collection $doctors;
    private int $articlesCount;
    private int $articlePagination;

    public function __construct()
    {
        $this->pages = Page::whereNotNull('slug')
            ->whereNotIn('slug', ['header', 'footer'])
            ->get();

        $this->articles = Article::whereNotNull('slug')
            ->get();

        $this->doctors = Doctor::with('translations')
            ->get();

        $this->articlesCount = Article::count();
        $this->articlePagination = 9;
    }

    /**
     * Отримує всіх URL сторінок.
     *
     * @return array
     */
    final public function getUrls(): array
    {
        return array_unique(array_map([$this, 'formatUrl'], [
            ...$this->getStaticPageUrls(),
            ...$this->getRuStaticPageUrls(),
            ...$this->getEnStaticPageUrls(),

            ...$this->getPageUrls(),
            ...$this->getRuPageUrls(),
            ...$this->getEnPageUrls(),

            ...$this->getArticlesPagesUrls(),
            ...$this->getRuArticlesPagesUrls(),
            ...$this->getEnArticlesPagesUrls(),

            ...$this->getArticlesUrls(),
            ...$this->getRuArticlesUrls(),
            ...$this->getEnArticlesUrls(),

            ...$this->getDoctorsUrls(),
            ...$this->getRuDoctorsUrls(),
            ...$this->getEnDoctorsUrls(),
        ]));
    }

    /**
     * Отримує URL статей.
     *
     * @return array
     */

    private function getStaticPageUrls()
    {
        return [
            '/ua/',
            '/ua/vakansii/',
            '/ua//vzroslym/hirurgiya/',
            '/ua/laboratories/',
            '/ua/nashi-speczialisty/',
            '/ua/check-up/',
            '/ua/akczii-i-speczialnye-predlozheniya/',
            '/ua/directions/',
            '/ua/staczionar/',
            '/ua/offices/',
            '/ua/contacts-search-filter/',
            '/ua/contacts/',
            '/ua/prices/',
            '/ua/otzyvy/',
            '/ua/about-us/',
        ];
    }

    private function getRuStaticPageUrls()
    {
        return [
            '',
            '/vakansii/',
            '/vzroslym/hirurgiya/',
            '/laboratories/',
            '/nashi-speczialisty/',
            '/check-up/',
            '/akczii-i-speczialnye-predlozheniya/',
            '/directions/',
            '/staczionar/',
            '/offices/',
            '/contacts-search-filter/',
            '/contacts/',
            '/prices/',
            '/otzyvy/',
            '/about-us/',
        ];
    }

    private function getENStaticPageUrls()
    {
        return [
            '/en/',
            '/en/vakansii/',
            '/en//vzroslym/hirurgiya/',
            '/en/laboratories/',
            '/en/nashi-speczialisty/',
            '/en/check-up/',
            '/en/akczii-i-speczialnye-predlozheniya/',
            '/en/directions/',
            '/en/staczionar/',
            '/en/offices/',
            '/en/contacts-search-filter/',
            '/en/contacts/',
            '/en/prices/',
            '/en/otzyvy/',
            '/en/about-us/',
        ];
    }

    /**
     * Отримує URL статей.
     *
     * @return array
     */
    private function getArticlesPagesUrls()
    {
        $basePath = '/ua/dlya-paczientov/';

        $totalPages = (int) ceil($this->articlesCount / $this->articlePagination);

        $pages = [];

        $pages[] = $basePath;

        for ($page = 2; $page <= $totalPages; $page++) {
            $pages[] = $basePath."page/$page/";
        }

        return $pages;
    }

    private function getRuArticlesPagesUrls()
    {
        $basePath = '/dlya-paczientov/';

        $totalPages = (int) ceil($this->articlesCount / $this->articlePagination);

        $pages = [];

        $pages[] = $basePath;

        for ($page = 2; $page <= $totalPages; $page++) {
            $pages[] = $basePath."page/$page/";
        }

        return $pages;
    }

    private function getEnArticlesPagesUrls()
    {
        $basePath = '/en/dlya-paczientov/';

        $totalPages = (int) ceil($this->articlesCount / $this->articlePagination);

        $pages = [];

        $pages[] = $basePath;

        for ($page = 2; $page <= $totalPages; $page++) {
            $pages[] = $basePath."page/$page/";
        }

        return $pages;
    }

    /**
     * Отримує URL статей.
     *
     * @return array
     */
    private function getArticlesUrls(): array
    {
        return $this->articles->map(function ($article) {
            return '/ua/dlya-paczientov/' . $article->slug;
        })->all();
    }

    private function getRuArticlesUrls(): array
    {
        return $this->articles->map(function ($article) {
            return '/dlya-paczientov/' . $article->slug;
        })->all();
    }

    private function getEnArticlesUrls(): array
    {
        return $this->articles->map(function ($article) {
            return '/en/dlya-paczientov/' . $article->slug;
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
            return 'ua/'.$page->slug;
        })->all();
    }

    private function getRuPageUrls()
    {
        return $this->pages->map( function ($page) {
            return $page->slug;
        })->all();
    }

    private function getEnPageUrls()
    {
        return $this->pages->map( function ($page) {
            return 'en/' . $page->slug;
        })->all();
    }

    /**
     * Отримує URL сторінок.
     *
     * @return array
     */

    private function getDoctorsUrls(): array
    {
        return $this->doctors
            ->map(function ($doctor) {
                $translation = $doctor->translations->firstWhere('locale', 'ua');

                if ($translation && $translation->slug) {
                    return '/ua/nashi-speczialisty/' . $translation->slug;
                }

                return null;
            })
            ->filter()
            ->all();
    }

    private function getRuDoctorsUrls(): array
    {
        return $this->doctors
            ->map(function ($doctor) {
                $translation = $doctor->translations->firstWhere('locale', 'ru');

                if ($translation && $translation->slug) {
                    return '/nashi-speczialisty/' . $translation->slug;
                }

                return null;
            })
            ->filter()
            ->all();
    }

    private function getEnDoctorsUrls(): array
    {
        return $this->doctors
            ->map(function ($doctor) {
                $translation = $doctor->translations->firstWhere('locale', 'en');

                if ($translation && $translation->slug) {
                    return '/en/nashi-speczialisty/' . $translation->slug;
                }

                return null;
            })
            ->filter()
            ->all();
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
