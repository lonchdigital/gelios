<?php

namespace App\Services\Sitemap;

class SitemapValidatorService
{
    private string $robotsTxtContent;

    private array $allows = [];
    private array $disallows = [];

    public function __construct()
    {
        $this->robotsTxtContent = file_get_contents(public_path('robots.txt'));

        $this->setAllows();
        $this->setDisallows();
    }

    final public function validate(array $urls): array
    {
        if ($this->hasDisallowAll()) {
            $urls = $this->allows;
        } else {
            $urls = $this->filterDisallowedUrls($urls);
            $urls = array_merge($urls, $this->allows);
        }

        return $urls;
    }

    private function filterDisallowedUrls(array $urls): array
    {
        $result = [];

        foreach ($this->disallows as $disallowedUrl) {
            // Прибираєм '*' для обробки строки
            $disallowedUrlFormatted = str_replace('*', '', $disallowedUrl);

            // Екрануємо всі спеціальні символи у $disallowedUrl
            $escapedRule = preg_quote($disallowedUrlFormatted, '/');

            // Регулярний вираз для фільтрації
            $filterRegex = str_ends_with($disallowedUrl, '*')
                ? "/^{$escapedRule}/"
                : (str_starts_with($disallowedUrl, '*')
                    ? "/{$escapedRule}$/"
                    : "/^{$escapedRule}$/");

            // Фільтрація урлів
            $filteredUrls = preg_grep($filterRegex, $urls);

            // Запис результатів
            $result += $filteredUrls;
        }

        return array_diff($urls, array_unique($result));
    }


    private function setAllows(): void
    {
        preg_match_all('/Allow:(.*?)\$/', $this->robotsTxtContent, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $this->allows[] = trim($match[1]);
        }
    }

    private function setDisallows(): void
    {
        preg_match_all('/Disallow:(.*)/', $this->robotsTxtContent, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $this->disallows[] = trim($match[1]);
        }
    }

    private function hasDisallowAll(): bool
    {
        return false;
        // in_array('/', $this->disallows);
    }
}
