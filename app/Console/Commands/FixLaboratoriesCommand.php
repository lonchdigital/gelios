<?php

namespace App\Console\Commands;

use App\Models\PageBlock;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ixLaboratoriesCommand extends Command
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
        $block1 = PageBlock::find(20);

        $block1->update([
            'block' => 'second_block',
            'key' => 'first',
        ]);

        $block2 = PageBlock::find(21);

        $block2->update([
            'block' => 'second_block',
            'key' => 'second',
        ]);

        $block3 = PageBlock::find(22);

        $block3->update([
            'block' => 'second_block',
            'key' => 'third',
        ]);

        $block4 = PageBlock::find(23);

        $block4->update([
            'block' => 'prices',
            'key' => 'text',
        ]);

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => 5,
            'block' => 'second_block',
            'key' => 'fourth',
        ]);

        $pageBlock->translateOrNew('ua')->title = 'Комфортні умови здачі';
        $pageBlock->translateOrNew('ru')->title = 'Комфортні умови здачі';
        $pageBlock->translateOrNew('en')->title = 'Комфортні умови здачі';

        $pageBlock->save();

        return Command::SUCCESS;
    }
}
