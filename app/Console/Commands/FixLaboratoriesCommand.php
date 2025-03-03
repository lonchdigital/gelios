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
        // Page::where('type', PageType::LABORATORY->value)
        //     ->first()
        //     ->update([
        //         'slug' => 'laboratories',
        //     ]);

        // $block = PageBlock::find(28);

        // $block->update([
        //     'block' => 'main',
        //     'key' => 'slider'
        // ]);

        // $block = PageBlock::find(31);

        // $block->update([
        //     'block' => 'main',
        //     'key' => 'slider'
        // ]);

        // $block = PageBlock::find(38);

        // $block->update([
        //     'block' => 'main',
        //     'key' => 'slider'
        // ]);

        return Command::SUCCESS;
    }
}
