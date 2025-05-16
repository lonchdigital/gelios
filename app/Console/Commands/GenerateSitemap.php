<?php

namespace App\Console\Commands;

use App\Jobs\SitemapGenerateJob;
use App\Services\Sitemap\SitemapPageService;
use App\Services\Sitemap\SitemapService;
use App\Services\Sitemap\SitemapSettingService;
use App\Services\Sitemap\SitemapValidatorService;
use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TooManyRedirectsException;
use Illuminate\Console\Command;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap for the website';

    private Sitemap $sitemap;
    private SitemapValidatorService $validator;
    private SitemapSettingService $settingService;

    /**
     * Execute the console command.
     */

     public function __construct(SitemapValidatorService $validator, SitemapSettingService $settingService)
     {
         parent::__construct();

         $this->validator = $validator;
         $this->settingService = $settingService;

         $this->sitemap = new Sitemap;
     }

    public function handle()
    {
        $this->generate();

        $this->info('Sitemap generated successfully.');
        // try {
        //     $sitemapService = app(SitemapService::class);
        //     $sitemapService->generate();
        //     // SitemapGenerateJob::dispatch();
        //     $this->info('Sitemap generated successfully.');
        // } catch (\Exception $exception) {
        //     $this->error($exception->getMessage());
        // }
    }

    public function generate(): Response
    {
        $service = resolve(SitemapPageService::class);

        $urls = $this->validator->validate($service->getUrls());

        $urls = $this->filterUrl($urls);

        $this->fillSitemap($urls);

        $xmlContent = $this->sitemap->render();

        // $xmlContentWithSlashes = str_replace('</loc>', '/</loc>', $xmlContent);
        // file_put_contents(public_path('sitemap.xml'), $xmlContentWithSlashes);
        $xmlContentWithSlashes = file_put_contents(public_path('sitemap.xml'), $xmlContent);

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

            // $changeFreq = match (true) {
            //     $url === '/' => 'always',
            //     str_starts_with($url, '/categories') => 'always',
            //     str_starts_with($url, '/doctors') => 'always',
            //     str_starts_with($url, '/blog') => 'daily',
            //     default => 'weekly',
            // };

            $lastMod = $settings['lastmod'] ?? Carbon::now();

            $tag = Url::create(config('app.url') . $url)
                // ->setChangeFrequency($changeFreq)
                ->setPriority($settings['priority'] ?? 0.5)
                ->setLastModificationDate(Carbon::parse($lastMod));

            $this->sitemap->add($tag);
        }
    }

    private function filterUrl(array $urls): array
    {
        $filteredUrls = [];

        $bar = $this->output->createProgressBar(count($urls));
        $bar->start();
        $this->newLine();

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

            $bar->advance();
        }

        $this->newLine();
        $bar->finish();
        $this->newLine();


        return $filteredUrls;
    }
}
