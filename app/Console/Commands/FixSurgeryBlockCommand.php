<?php

namespace App\Console\Commands;

use App\Enums\PageType;
use App\Models\Page;
use App\Models\PageBlock;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class FixSurgeryBlockCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:surgery';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix surgery block';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $page = Page::where('type', PageType::SURGERY->value)->first();

        $block = $page->pageBlocks()
            ->where('block', 'second')
            ->where('key', 'image')
            ->first();

        if(!empty($block->id)) {
            $block->delete();
        }

        return Command::SUCCESS;
    }
}
