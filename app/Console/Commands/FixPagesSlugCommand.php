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
        $page1 = Page::where('type', PageType::INSURANCECOMPANIES->value)
            ->first();

        $page1->update([
                'slug' => 'strahovym-kompaniyam'
            ]);

        PageTranslation::firstOrCreate([
            'page_id' => $page1->id,
            'locale' => 'ua',
        ]);

        PageTranslation::where('page_id', $page1->id)
            ->where('locale', 'ua')
            ->first()
            ->update([
                'title' => 'Страхові компанії',
            ]);

        PageTranslation::firstOrCreate([
            'page_id' => $page1->id,
            'locale' => 'ru',
        ]);

        PageTranslation::where('page_id', $page1->id)
            ->where('locale', 'ru')
            ->first()->update([
                'title' => 'Страховые',
            ]);

        // REVIEWS
        $page2 = Page::where('type', PageType::REVIEWS->value)
            ->first();

        $page2->update([
                'slug' => 'otzyvy'
            ]);

        $uaTrans2 = PageTranslation::firstOrCreate([
            'page_id' => $page2->id,
            'locale' => 'ua',
        ]);

        $uaTrans2->update([
            'title' => 'Відгуки',
        ]);

        $ruTrans2 = PageTranslation::firstOrCreate([
            'page_id' => $page2->id,
            'locale' => 'ru',
        ]);

        $ruTrans2->update([
            'title' => 'Отзывы',
        ]);

        // PRICES
        $page3 = Page::where('type', PageType::PRICES->value)
            ->first();

        $page3->update([
                'slug' => 'prices'
            ]);

        $uaTrans3 = PageTranslation::firstOrCreate([
            'page_id' => $page3->id,
            'locale' => 'ua',
        ]);

        $uaTrans3->update([
            'title' => 'Ціни',
        ]);

        $ruTrans3 = PageTranslation::firstOrCreate([
            'page_id' => $page3->id,
            'locale' => 'ru',
        ]);

        $ruTrans3->update([
            'title' => 'Цены',
        ]);

        // OFFICES
        $page4 = Page::where('type', PageType::OFFICES->value)
            ->first();

        $page4->update([
                'slug' => 'offices'
            ]);

        $uaTrans4 = PageTranslation::firstOrCreate([
            'page_id' => $page4->id,
            'locale' => 'ua',
        ]);

        $uaTrans4->update([
            'title' => 'Філії',
        ]);

        $ruTrans4 = PageTranslation::firstOrCreate([
            'page_id' => $page4->id,
            'locale' => 'ru',
        ]);

        $ruTrans4->update([
            'title' => 'Филиалы',
        ]);

        // CHECKUP
        $page5 = Page::where('type', PageType::CHECKUP->value)
            ->first();

        $page5->update([
                'slug' => 'check-up'
            ]);

        $uaTrans5 = PageTranslation::firstOrCreate([
            'page_id' => $page5->id,
            'locale' => 'ua',
        ]);

        $uaTrans5->update([
            'title' => 'Сheck up',
        ]);

        $ruTrans5 = PageTranslation::firstOrCreate([
            'page_id' => $page5->id,
            'locale' => 'ru',
        ]);

        $ruTrans5->update([
            'title' => 'Check up',
        ]);

        // SURGERY
        $page6 = Page::where('type', PageType::SURGERY->value)
            ->first();

        $page6->update([
                'slug' => 'vzroslym/hirurgiya'
            ]);

        $uaTrans6 = PageTranslation::firstOrCreate([
            'page_id' => $page6->id,
            'locale' => 'ua',
        ]);

        $uaTrans6->update([
            'title' => 'Хірургія',
        ]);

        $ruTrans6 = PageTranslation::firstOrCreate([
            'page_id' => $page6->id,
            'locale' => 'ru',
        ]);

        $ruTrans6->update([
            'title' => 'Хирургия',
        ]);

        // OPENING
        $page7 = Page::where('type', PageType::OPENING->value)
            ->first();

        $page7->update([
                'slug' => 'vakansii'
            ]);

        $uaTrans7 = PageTranslation::firstOrCreate([
            'page_id' => $page7->id,
            'locale' => 'ua',
        ]);

        $uaTrans7->update([
            'title' => 'Вакансії',
        ]);

        $ruTrans7 = PageTranslation::firstOrCreate([
            'page_id' => $page7->id,
            'locale' => 'ru',
        ]);

        $ruTrans7->update([
            'title' => 'Вакансии',
        ]);

        // LABORATORIES
        $page8 = Page::where('type', PageType::LABORATORY->value)
            ->first();

        $uaTrans8 = PageTranslation::firstOrCreate([
            'page_id' => $page8->id,
            'locale' => 'ua',
        ]);

        $uaTrans8->update([
            'title' => 'Лабораторії',
        ]);

        $ruTrans8 = PageTranslation::firstOrCreate([
            'page_id' => $page8->id,
            'locale' => 'ru',
        ]);

        $ruTrans8->update([
            'title' => 'Лаборатории',
        ]);

        return Command::SUCCESS;
    }
}
