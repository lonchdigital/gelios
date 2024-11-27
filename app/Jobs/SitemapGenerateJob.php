<?php

namespace App\Jobs;

use App\Services\Sitemap\SitemapService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Response;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SitemapGenerateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private SitemapService $sitemapService;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->sitemapService = app(SitemapService::class);
    }

    /**
     * Execute the job.
     */
    final public function handle(): Response
    {
        return $this->sitemapService->generate();
    }
}
