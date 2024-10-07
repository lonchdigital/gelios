<?php

namespace Database\Seeders;

use App\Enums\PageType;
use App\Models\Page;
use App\Models\PageBlock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::firstOrCreate([
            'type' => PageType::ABOUT->value,
        ]);

        Page::firstOrCreate([
            'type' => PageType::MAINPAGE->value,
        ]);


        Page::firstOrCreate([
            'type' => PageType::CONTACTS->value,
        ]);


        Page::firstOrCreate([
            'type' => PageType::HOSPITAL->value,
        ]);


        Page::firstOrCreate([
            'type' => PageType::LABORATORY->value,
        ]);


        Page::firstOrCreate([
            'type' => PageType::BLOG->value,
        ]);

        Page::firstOrCreate([
            'type' => PageType::OFFICES->value,
        ]);

        Page::firstOrCreate([
            'type' => PageType::OPENING->value,
        ]);

        Page::firstOrCreate([
            'type' => PageType::DIRECTIONS->value,
        ]);

        Page::firstOrCreate([
            'type' => PageType::PARTNERS->value,
        ]);

        Page::firstOrCreate([
            'type' => PageType::PRICES->value,
        ]);

        Page::firstOrCreate([
            'type' => PageType::REHABILITATIONCENTER->value,
        ]);

        Page::firstOrCreate([
            'type' => PageType::ONECENTER->value,
        ]);

        Page::firstOrCreate([
            'type' => PageType::REVIEWS->value,
        ]);

        Page::firstOrCreate([
            'type' => PageType::SHARES->value,
        ]);

        Page::firstOrCreate([
            'type' => PageType::SHARESITEM->value,
        ]);

        Page::firstOrCreate([
            'type' => PageType::SUBCATEGORY->value,
        ]);

        // Хірургія

        $page = Page::firstOrCreate([
            'type' => PageType::SURGERY->value,
        ]);

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'main',
            'key' => 'content',
        ]);

        $pageBlock->translateOrNew('ua')->title = 'Хірург у Дніпрі';
        $pageBlock->translateOrNew('ua')->description = 'Безкоштовна консультація';
        $pageBlock->translateOrNew('ru')->title = 'Хірург у Дніпрі';
        $pageBlock->translateOrNew('ru')->description = 'Безкоштовна консультація';
        $pageBlock->translateOrNew('en')->title = 'Хірург у Дніпрі';
        $pageBlock->translateOrNew('en')->description = 'Безкоштовна консультація';

        $pageBlock->save();

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'second',
            'key' => 'image',
        ]);

        $pageBlock->translateOrNew('ua')->title = '';
        $pageBlock->translateOrNew('ua')->description = '';
        $pageBlock->translateOrNew('ru')->title = '';
        $pageBlock->translateOrNew('ru')->description = '';
        $pageBlock->translateOrNew('en')->title = '';
        $pageBlock->translateOrNew('en')->description = '';

        $pageBlock->save();

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'second',
            'key' => 'first',
        ]);

        $pageBlock->translateOrNew('ua')->title = '2 640';
        $pageBlock->translateOrNew('ua')->description = 'Проведено операцій';
        $pageBlock->translateOrNew('ru')->title = '2 640';
        $pageBlock->translateOrNew('ru')->description = 'Проведено операцій';
        $pageBlock->translateOrNew('en')->title = '2 640';
        $pageBlock->translateOrNew('en')->description = 'Проведено операцій';

        $pageBlock->save();

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'second',
            'key' => 'second',
        ]);

        $pageBlock->translateOrNew('ua')->title = '14';
        $pageBlock->translateOrNew('ua')->description = 'Років досвіду';
        $pageBlock->translateOrNew('ru')->title = '14';
        $pageBlock->translateOrNew('ru')->description = 'Років досвіду';
        $pageBlock->translateOrNew('en')->title = '14';
        $pageBlock->translateOrNew('en')->description = 'Років досвіду';

        $pageBlock->save();

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'second',
            'key' => 'third',
        ]);

        $pageBlock->translateOrNew('ua')->title = '24/7';
        $pageBlock->translateOrNew('ua')->description = 'Ми поряд';
        $pageBlock->translateOrNew('ru')->title = '24/7';
        $pageBlock->translateOrNew('ru')->description = 'Ми поряд';
        $pageBlock->translateOrNew('en')->title = '24/7';
        $pageBlock->translateOrNew('en')->description = 'Ми поряд';

        $pageBlock->save();

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'second',
            'key' => 'fourth',
        ]);

        $pageBlock->translateOrNew('ua')->title = '100 000';
        $pageBlock->translateOrNew('ua')->description = 'Відвідувань щороку';
        $pageBlock->translateOrNew('ru')->title = '100 000';
        $pageBlock->translateOrNew('ru')->description = 'Відвідувань щороку';
        $pageBlock->translateOrNew('en')->title = '100 000';
        $pageBlock->translateOrNew('en')->description = 'Відвідувань щороку';

        $pageBlock->save();

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'directions',
            'key' => 'title',
        ]);

        $pageBlock->translateOrNew('ua')->title = 'Напрямки у хірургії у медцентрі “Геліос”';
        $pageBlock->translateOrNew('ru')->title = 'Напрямки у хірургії у медцентрі “Геліос”';
        $pageBlock->translateOrNew('en')->title = 'Напрямки у хірургії у медцентрі “Геліос”';

        $pageBlock->save();

        PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => '3d',
            'key' => 'link',
        ]);

        Page::firstOrCreate([
            'type' => PageType::TEXT->value,
        ]);

        Page::firstOrCreate([
            'type' => PageType::CHECKUP->value,
        ]);

        Page::firstOrCreate([
            'type' => PageType::CHECKUPITEM->value,
        ]);

        Page::firstOrCreate([
            'type' => PageType::TYPICAL->value,
        ]);

        // PageBlock::
    }
}
