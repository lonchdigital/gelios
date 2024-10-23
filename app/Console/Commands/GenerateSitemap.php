<?php

namespace App\Console\Commands;

use App\Jobs\SitemapGenerateJob;
use Illuminate\Console\Command;

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

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            SitemapGenerateJob::dispatch();
            $this->info('Sitemap generated successfully.');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
