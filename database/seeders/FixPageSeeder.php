<?php

namespace Database\Seeders;

use App\Enums\PageType;
use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FixPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $page1 = Page::firstOrCreate([
            'type' => PageType::ABOUT->value,
        ]);

        $page1->update([
            'slug' => 'about-us'
        ]);

        // $page1->translateOrNew('ua')->title = 'Про компанію';
        // $page1->translateOrNew('ru')->title = 'Про компанію';
        // $page1->translateOrNew('en')->title = 'About us';

        $page1->save();

        $page2 = Page::firstOrCreate([
            'type' => PageType::DOCTOR->value,
        ]);

        $page2->update([
            'slug' => 'nashi-speczialisty'
        ]);

        // $page2->translateOrNew('ua')->title = 'Лікарі';
        // $page2->translateOrNew('ru')->title = 'Лікарі';
        // $page2->translateOrNew('en')->title = 'Doctors';

        $page2->save();

        $page3 = Page::firstOrCreate([
            'type' => PageType::SHARES->value,
        ]);

        $page3->update([
            'slug' => 'akczii-i-speczialnye-predlozheniya'
        ]);

        // $page3->translateOrNew('ua')->title = 'Акції';
        // $page3->translateOrNew('ru')->title = 'Акції';
        // $page3->translateOrNew('en')->title = 'Promotions';

        $page3->save();

        $page4 = Page::firstOrCreate([
            'type' => PageType::BLOG->value,
        ]);

        $page4->update([
            'slug' => 'dlya-paczientov'
        ]);

        // $page4->translateOrNew('ua')->title = 'Новини';
        // $page4->translateOrNew('ru')->title = 'Новини';
        // $page4->translateOrNew('en')->title = 'News';

        $page4->save();

        $page5 = Page::firstOrCreate([
            'type' => PageType::CONTACTS->value,
        ]);

        $page5->update([
            'slug' => 'contacts'
        ]);

        // $page5->translateOrNew('ua')->title = 'Контакти';
        // $page5->translateOrNew('ru')->title = 'Контакти';
        // $page5->translateOrNew('en')->title = 'Contacts';

        $page5->save();

        $page6 = Page::firstOrCreate([
            'type' => PageType::PRICES->value,
        ]);

        $page6->update([
            'slug' => 'prices'
        ]);

        // $page6->translateOrNew('ua')->title = 'Ціни';
        // $page6->translateOrNew('ru')->title = 'Ціни';
        // $page6->translateOrNew('en')->title = 'Prices';

        $page6->save();

        $page7 = Page::firstOrCreate([
            'type' => PageType::HOSPITAL->value,
        ]);

        $page7->update([
            'slug' => 'staczionar'
        ]);

        // $page7->translateOrNew('ua')->title = 'Стаціонар';
        // $page7->translateOrNew('ru')->title = 'Стаціонар';
        // $page7->translateOrNew('en')->title = 'Hospital';

        $page7->save();
    }
}
