<?php

namespace App\Services\Sitemap;


use App\Models\Page;

final class SitemapSettingService
{
    public function getUrlSettings(string $url): array
    {
        if ($this->isBlog($url)) {
            return [
                'priority' => 0.7,
                'frequency' => 'weekly',
            ];
        }

        if ($this->isDoctor($url)) {
            return [
                'priority' => 0.7,
                'frequency' => 'weekly',
            ];
        }

        if ($this->isMainPage($url)) {
            return [
                'priority' => 1,
                'frequency' => 'always',
            ];
        }

        if ($this->isPage($url)) {
            return [
                'priority' => 0.8,
                'frequency' => 'weekly',
            ];
        }

        return [
            'priority' => 0.6,
            'frequency' => 'monthly',
        ];
    }

    private function isPage(string $url): bool
    {
        return $url !== '/' || $url !== '/ru/' || $url !== '/en/';
    }

    private function isBlog(string $url): bool
    {
        return in_array('blog', explode('/', $url));
    }

    private function isDoctor(string $url): bool
    {
        return in_array('nashi-speczialisty', explode('/', $url));
    }

    private function isMainPage(string $url): bool
    {
        return $url === '/' || $url === '/ru/' || $url === '/en/';
    }
}
