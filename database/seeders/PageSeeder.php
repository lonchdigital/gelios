<?php

namespace Database\Seeders;

use App\Enums\PageType;
use App\Models\Page;
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

        Page::firstOrCreate([
            'type' => PageType::SURGERY->value,
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
