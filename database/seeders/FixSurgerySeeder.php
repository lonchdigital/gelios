<?php

namespace Database\Seeders;

use App\Enums\PageType;
use App\Models\Page;
use App\Models\PageBlock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FixSurgerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $page = Page::firstOrCreate([
            'type' => PageType::SURGERY->value,
        ]);

        PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'second',
            'key' => 'image',
        ]);

        PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'second',
            'key' => 'first',
        ]);

        PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'second',
            'key' => 'second',
        ]);

        PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'second',
            'key' => 'third',
        ]);

        PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'second',
            'key' => 'fourth',
        ]);
    }
}
