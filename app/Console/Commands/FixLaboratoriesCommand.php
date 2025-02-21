<?php

namespace App\Console\Commands;

use App\Enums\PageType;
use App\Models\Page;
use App\Models\PageBlock;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class FixLaboratoriesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:laboratories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix laboratories table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $block = PageBlock::find(66);

        $block->update([
            'group' => 'main',
            'key' => 'slider'
        ]);

        $page = Page::where('type', PageType::SURGERY->value)
            ->first();

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'conditions',
            'key' => 'title',
        ]);

        $pageBlock->translateOrNew('ua')->title = 'Умови перебування';
        $pageBlock->translateOrNew('ru')->title = 'Умови перебування';
        $pageBlock->translateOrNew('en')->title = 'Умови перебування';

        $pageBlock->save();

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => '3d',
            'key' => 'link',
        ]);

        $pageBlock->save();

        return Command::SUCCESS;
    }
}
