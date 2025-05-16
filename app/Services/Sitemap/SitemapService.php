<?php

namespace App\Services\Sitemap;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TooManyRedirectsException;
use Illuminate\Http\Client\ConnectionException;
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
        // foreach ($urls as $url) {
        //     $settings = $this->settingService->getUrlSettings($url);

        //     $tag = Url::create($url)
        //         ->setChangeFrequency($settings['frequency'])
        //         ->setPriority($settings['priority']);

        //     $this->sitemap->add($tag);
        // }
        foreach ($urls as $url) {
            $settings = $this->settingService->getUrlSettings($url);

            // Визначення частоти оновлення залежно від URL
            $changeFreq = match (true) {
                $url === '/' => 'always',
                str_starts_with($url, '/categories') => 'always',
                str_starts_with($url, '/doctors') => 'always',
                str_starts_with($url, '/blog') => 'daily',
                default => 'weekly',
            };

            // Отримати дату останньої модифікації (можна реалізувати в settingService)
            $lastMod = $settings['lastmod'] ?? Carbon::now();

            $tag = Url::create(config('app.url') . $url)
                ->setChangeFrequency($changeFreq)
                ->setPriority($settings['priority'] ?? 0.5)
                ->setLastModificationDate(Carbon::parse($lastMod));

            $this->sitemap->add($tag);
        }
    }

    // private function filterUrl(array $urls): array
    // {
    //     foreach ($urls as $key => $url) {
    //         $response = Http::get(config('app.url') . $url);

    //         if ($response->status() === 404 || $response->status() === 500) {
    //             unset($urls[$key]);
    //         }
    //     }

    //     return $urls;
    // }
    //////////
    // private function filterUrl(array $urls): array
    // {
    //     foreach ($urls as $key => $url) {
    //         if($url !== '/pediatriya/pediatriya-dityacha') {
    //             $response = Http::withOptions(['stream' => true])
    //             ->withHeaders([
    //                     'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
    //                 ])
    //             ->head(
    //             // config('app.url')
    //                 'http://helyos.lonchdev.com' . $url);

    //             if ($response->status() === 404 || $response->status() === 500) {
    //                 unset($urls[$key]);
    //             }

    //             unset($response);

    //             // usleep(1000000);

    //             // if ($key % 10 === 0) {
    //             //     usleep(1000000);
    //             // }
    //         }
    //     }

    //     return array_values($urls);
    // }
    ///////////

    // private function filterUrl(array $urls): array
    // {
    //     foreach ($urls as $key => $url) {
    //         try {
    //             $response = Http::head('http://helyos.lonchdev.com' . $url)->throw(); // Кидає виняток при помилці
    //             $status = $response->status();
    //         } catch (RequestException | ConnectionException $e) {
    //             $status = 500; // Якщо помилка з'єднання — вважаємо URL недоступним
    //         }

    //         if (in_array($status, [404, 500])) {
    //             unset($urls[$key]);
    //         }
    //     }

    //     return array_values($urls);
    // }
    private function filterUrl(array $urls): array
    {
        $filteredUrls = [];

        foreach ($urls as $url) {
            // $fullUrl = filter_var($url, FILTER_VALIDATE_URL) ? $url : 'http://helyos.lonchdev.com' . $url;
            // $fullUrl = 'http://helyos.lonchdev.com' . $url;
            $fullUrl = config('app.url') . $url;
            // config('app.url')

            try {
                $response = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                ])->withoutVerifying()->head($fullUrl);

                $status = $response->status();
            } catch (TooManyRedirectsException $e) {
                Log::info("🔄 Забагато перенаправлень: {$fullUrl}");
                $status = 500;
            } catch (ConnectionException $e) {
                Log::info("⛔ Відмова у з'єднанні: {$fullUrl}");
                $status = 500;
            } catch (RequestException $e) {
                Log::info("❌ Помилка HTTP-запиту: {$fullUrl} | Код: " . $e->response->status());
                $status = $e->response->status();
            } catch (\Exception $e) {
                Log::info("🚨 Невідома помилка: {$fullUrl} | " . $e->getMessage());
                $status = 500;
            }

            if ($status !== 404 && $status !== 500) {
                $filteredUrls[] = $url;
            }
        }

        return $filteredUrls;
    }
}
