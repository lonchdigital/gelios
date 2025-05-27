<?php

namespace App\Console\Commands;

use App\Enums\PageType;
use App\Models\Page;
use App\Models\PageBlock;
use App\Models\PageTranslation;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class FixPagesSlugCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:slug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix pages slugs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // INSURANCECOMPANIES
        $page = Page::where('type', PageType::CONTACTS->value)
            ->first();

        $page->update([
            'slug' => 'contact-us'
        ]);

        return Command::SUCCESS;
    }
}
