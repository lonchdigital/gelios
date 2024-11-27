<?php

namespace App\Services\Sitemap;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

final class SitemapService extends SitemapPageService
{
    private Sitemap $sitemap;
    private SitemapValidatorService $validator;
    private SitemapSettingService $settingService;

    public function __construct(SitemapValidatorService $validator, SitemapSettingService $settingService)
    {
        parent::__construct();

        $this->validator = $validator;
        $this->settingService = $settingService;

        $this->sitemap = new Sitemap;
    }

    final public function generate(): Response
    {
        $urls = $this->validator->validate($this->getUrls());

        $urls = $this->filterUrl($urls);

        $this->fillSitemap($urls);

        $xmlContent = $this->sitemap->render();

        $xmlContentWithSlashes = str_replace('</loc>', '/</loc>', $xmlContent);
        file_put_contents(public_path('sitemap.xml'), $xmlContentWithSlashes);

        return response($xmlContentWithSlashes)->header('Content-Type', 'application/xml');
    }

    private function fillSitemap(array $urls): void
    {
        foreach ($urls as $url) {
            $settings = $this->settingService->getUrlSettings($url);

            $tag = Url::create($url)
                ->setChangeFrequency($settings['frequency'])
                ->setPriority($settings['priority']);

            $this->sitemap->add($tag);
        }
    }

    private function filterUrl(array $urls): array
    {
        foreach ($urls as $key => $url) {
            $response = Http::get(config('app.url') . $url);

            if ($response->status() === 404 || $response->status() === 500) {
                unset($urls[$key]);
            }
        }

        return $urls;
    }
}
