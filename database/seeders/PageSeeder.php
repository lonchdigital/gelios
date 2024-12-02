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

        $page2 = Page::firstOrCreate([
            'type' => PageType::MAINPAGE->value,
        ]);

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page2->id,
            'block' => 'main',
            'key' => 'first',
        ]);

        $pageBlock->translateOrNew('ua')->title = 'Піклуєшся <br> про здоров’я?';
        $pageBlock->translateOrNew('ua')->description = 'Обери свій CHECK-UP!';
        $pageBlock->translateOrNew('ua')->button = 'Детальніше';
        $pageBlock->translateOrNew('ru')->title = 'Піклуєшся <br> про здоров’я?';
        $pageBlock->translateOrNew('ru')->description = 'Обери свій CHECK-UP!';
        $pageBlock->translateOrNew('ru')->button = 'Детальніше';
        $pageBlock->translateOrNew('en')->title = 'Піклуєшся <br> про здоров’я?';
        $pageBlock->translateOrNew('en')->description = 'Обери свій CHECK-UP!';
        $pageBlock->translateOrNew('en')->button = 'Детальніше';

        $pageBlock->save();

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page2->id,
            'block' => 'main',
            'key' => 'second',
        ]);

        $pageBlock->translateOrNew('ua')->title = 'Підпиши <br> декларацію <br> за 5 хвилин';
        $pageBlock->translateOrNew('ru')->title = 'Підпиши <br> декларацію <br> за 5 хвилин';
        $pageBlock->translateOrNew('en')->title = 'Підпиши <br> декларацію <br> за 5 хвилин';

        $pageBlock->save();

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page2->id,
            'block' => 'main',
            'key' => 'third',
        ]);

        $pageBlock->translateOrNew('ua')->title = 'Підпиши <br> декларацію <br> за 5 хвилин';
        $pageBlock->translateOrNew('ru')->title = 'Підпиши <br> декларацію <br> за 5 хвилин';
        $pageBlock->translateOrNew('en')->title = 'Підпиши <br> декларацію <br> за 5 хвилин';

        $pageBlock->save();

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page2->id,
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
            'page_id' => $page2->id,
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
            'page_id' => $page2->id,
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
            'page_id' => $page2->id,
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
            'page_id' => $page2->id,
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
            'page_id' => $page2->id,
            'block' => 'banner',
            'key' => 'content',
        ]);

        $pageBlock->translateOrNew('ua')->title = 'Про клініку <br> ”ГЕЛІОС”';
        $pageBlock->translateOrNew('ua')->description = 'Наші фахівці – це лікарі з великим досвідом наукової діяльності та практичної медицини, які володіють найсучаснішими медичними технологіями та методиками. Діагностика, лікування, профілактика, реабілітація та надання медичних послуг усім членам сім\'ї в рамках програми «Сімейний лікар».';
        $pageBlock->translateOrNew('ua')->button = 'Детальніше';
        $pageBlock->translateOrNew('ru')->title = 'Про клініку <br> ”ГЕЛІОС”';
        $pageBlock->translateOrNew('ru')->description = 'Наші фахівці – це лікарі з великим досвідом наукової діяльності та практичної медицини, які володіють найсучаснішими медичними технологіями та методиками. Діагностика, лікування, профілактика, реабілітація та надання медичних послуг усім членам сім\'ї в рамках програми «Сімейний лікар».';
        $pageBlock->translateOrNew('ru')->button = 'Детальніше';
        $pageBlock->translateOrNew('en')->title = 'Про клініку <br> ”ГЕЛІОС”';
        $pageBlock->translateOrNew('en')->description = 'Наші фахівці – це лікарі з великим досвідом наукової діяльності та практичної медицини, які володіють найсучаснішими медичними технологіями та методиками. Діагностика, лікування, профілактика, реабілітація та надання медичних послуг усім членам сім\'ї в рамках програми «Сімейний лікар».';
        $pageBlock->translateOrNew('en')->button = 'Детальніше';

        $pageBlock->save();

        // $pageBlock = PageBlock::firstOrCreate([
        //     'page_id' => $page2->id,
        //     'block' => 'directions',
        //     'key' => 'text',
        // ]);

        // $pageBlock->translateOrNew('ua')->title = 'Наші напрямки';
        // $pageBlock->translateOrNew('ua')->description = 'Передові медичні технології діагностики, лікування та реабілітації пацієнтів усіх вікових груп.';
        // $pageBlock->translateOrNew('ua')->button = 'Усі напрямки';
        // $pageBlock->translateOrNew('ru')->title = 'Наші напрямки';
        // $pageBlock->translateOrNew('ru')->description = 'Передові медичні технології діагностики, лікування та реабілітації пацієнтів усіх вікових груп.';
        // $pageBlock->translateOrNew('ru')->button = 'Усі напрямки';
        // $pageBlock->translateOrNew('en')->title = 'Наші напрямки';
        // $pageBlock->translateOrNew('en')->description = 'Передові медичні технології діагностики, лікування та реабілітації пацієнтів усіх вікових груп.';
        // $pageBlock->translateOrNew('en')->button = 'Усі напрямки';

        // $pageBlock->save();

        Page::firstOrCreate([
            'type' => PageType::CONTACTS->value,
        ]);


        Page::firstOrCreate([
            'type' => PageType::HOSPITAL->value,
        ]);


        $page = Page::firstOrCreate([
            'type' => PageType::LABORATORY->value,
        ]);

        $page = Page::firstOrCreate([
            'type' => PageType::ONELABORATORY->value,
        ]);

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'main',
            'key' => 'slider',
        ]);

        $pageBlock->translateOrNew('ua')->title = 'Підготовка <br>до здачі аналізів';
        $pageBlock->translateOrNew('ua')->description = 'Дізнайся, що потрібно';
        $pageBlock->translateOrNew('ua')->button = 'Детальніше';
        $pageBlock->translateOrNew('ru')->title = 'Підготовка <br>до здачі аналізів';
        $pageBlock->translateOrNew('ru')->description = 'Дізнайся, що потрібно';
        $pageBlock->translateOrNew('ru')->button = 'Детальніше';
        $pageBlock->translateOrNew('en')->title = 'Підготовка <br>до здачі аналізів';
        $pageBlock->translateOrNew('en')->description = 'Дізнайся, що потрібно';
        $pageBlock->translateOrNew('en')->button = 'Детальніше';

        $pageBlock->save();

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'main',
            'key' => 'slider',
        ]);

        $pageBlock->translateOrNew('ua')->title = 'Піклуєшся <br> про здоров’я?';
        $pageBlock->translateOrNew('ua')->description = 'Обери свій CHECK-UP!';
        $pageBlock->translateOrNew('ua')->button = 'Детальніше';
        $pageBlock->translateOrNew('ru')->title = 'Піклуєшся <br> про здоров’я?';
        $pageBlock->translateOrNew('ru')->description = 'Обери свій CHECK-UP!';
        $pageBlock->translateOrNew('ru')->button = 'Детальніше';
        $pageBlock->translateOrNew('en')->title = 'Піклуєшся <br> про здоров’я?';
        $pageBlock->translateOrNew('en')->description = 'Обери свій CHECK-UP!';
        $pageBlock->translateOrNew('en')->button = 'Детальніше';

        $pageBlock->save();

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'second_block',
            'key' => 'first',
        ]);

        $pageBlock->translateOrNew('ua')->title = 'Прийом аналізів у дітей';
        $pageBlock->translateOrNew('ru')->title = 'Прийом аналізів у дітей';
        $pageBlock->translateOrNew('en')->title = 'Прийом аналізів у дітей';

        $pageBlock->save();

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'second_block',
            'key' => 'second',
        ]);

        $pageBlock->translateOrNew('ua')->title = 'Можливість здачі ПЛР';
        $pageBlock->translateOrNew('ru')->title = 'Можливість здачі ПЛР';
        $pageBlock->translateOrNew('en')->title = 'Можливість здачі ПЛР';

        $pageBlock->save();

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'second_block',
            'key' => 'third',
        ]);

        $pageBlock->translateOrNew('ua')->title = 'Цілодобова підтримка';
        $pageBlock->translateOrNew('ru')->title = 'Цілодобова підтримка';
        $pageBlock->translateOrNew('en')->title = 'Цілодобова підтримка';

        $pageBlock->save();

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'second_block',
            'key' => 'fourth',
        ]);

        $pageBlock->translateOrNew('ua')->title = 'Комфортні умови здачі';
        $pageBlock->translateOrNew('ru')->title = 'Комфортні умови здачі';
        $pageBlock->translateOrNew('en')->title = 'Комфортні умови здачі';

        $pageBlock->save();

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'prices',
            'key' => 'text',
        ]);

        $pageBlock->translateOrNew('ua')->title = 'Ціни';
        $pageBlock->translateOrNew('ua')->description = 'Наші фахівці – це лікарі з великим досвідом
                                наукової діяльності та практичної медицини, які володіють найсучаснішими медичними
                                технологіями та методиками. Діагностика, лікування, профілактика, реабілітація та надання
                                медичних послуг усім членам сім\'ї в рамках програми «Сімейний лікар».';
        $pageBlock->translateOrNew('ua')->button = 'Переглянути';
        $pageBlock->translateOrNew('ru')->title = 'Ціни';
        $pageBlock->translateOrNew('ru')->description = 'Наші фахівці – це лікарі з великим досвідом
                                наукової діяльності та практичної медицини, які володіють найсучаснішими медичними
                                технологіями та методиками. Діагностика, лікування, профілактика, реабілітація та надання
                                медичних послуг усім членам сім\'ї в рамках програми «Сімейний лікар».';
        $pageBlock->translateOrNew('ru')->button = 'Переглянути';
        $pageBlock->translateOrNew('en')->title = 'Ціни';
        $pageBlock->translateOrNew('en')->description = 'Наші фахівці – це лікарі з великим досвідом
                                наукової діяльності та практичної медицини, які володіють найсучаснішими медичними
                                технологіями та методиками. Діагностика, лікування, профілактика, реабілітація та надання
                                медичних послуг усім членам сім\'ї в рамках програми «Сімейний лікар».';
        $pageBlock->translateOrNew('en')->button = 'Переглянути';

        $pageBlock->save();

        $page = Page::firstOrCreate([
            'type' => PageType::BLOG->value,
        ]);

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'main',
            'key' => 'slider',
        ]);

        $pageBlock->translateOrNew('ua')->title = 'Піклуєшся <br> про здоров’я?';
        $pageBlock->translateOrNew('ua')->description = 'Обери свій CHECK-UP!';
        $pageBlock->translateOrNew('ua')->button = 'Детальніше';
        $pageBlock->translateOrNew('ru')->title = 'Піклуєшся <br> про здоров’я?';
        $pageBlock->translateOrNew('ru')->description = 'Обери свій CHECK-UP!';
        $pageBlock->translateOrNew('ru')->button = 'Детальніше';
        $pageBlock->translateOrNew('en')->title = 'Піклуєшся <br> про здоров’я?';
        $pageBlock->translateOrNew('en')->description = 'Обери свій CHECK-UP!';
        $pageBlock->translateOrNew('en')->button = 'Детальніше';

        $pageBlock->save();

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'second_block',
            'key' => 'first',
        ]);

        $pageBlock->translateOrNew('ua')->title = 'Підпиши
                                                    декларацію
                                                    за 5 хвилин';

        $pageBlock->translateOrNew('ru')->title = 'Підпиши
                                                    декларацію
                                                    за 5 хвилин';

        $pageBlock->translateOrNew('en')->title = 'Підпиши
                                                    декларацію
                                                    за 5 хвилин';


        $pageBlock->save();

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'second_block',
            'key' => 'second',
        ]);

        $pageBlock->translateOrNew('ua')->title = 'Підпиши
                                                    декларацію
                                                    за 5 хвилин';

        $pageBlock->translateOrNew('ru')->title = 'Підпиши
                                                    декларацію
                                                    за 5 хвилин';

        $pageBlock->translateOrNew('en')->title = 'Підпиши
                                                    декларацію
                                                    за 5 хвилин';


        $pageBlock->save();

        $page = Page::firstOrCreate([
            'type' => PageType::ARTICLE->value,
        ]);

        $page = Page::firstOrCreate([
            'type' => PageType::DOCTOR->value,
        ]);

        $page = Page::firstOrCreate([
            'type' => PageType::ONEDOCTOR->value,
        ]);

        Page::firstOrCreate([
            'type' => PageType::OFFICES->value,
        ]);

        $page = Page::firstOrCreate([
            'type' => PageType::OPENING->value,
        ]);

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'main',
            'key' => 'text',
        ]);

        $pageBlock->translateOrNew('ua')->title = 'Наші вакансії';
        $pageBlock->translateOrNew('ua')->description = 'Ми відкриті для співпраці зі страховими компаніями і партнерами по обслуговуванню Пацієнтів з добровільного медичного страхування. Якщо у Вас є поліс ДМС, Ви можете звернутися в свою страхову компанію і попросити додати нашу клініку в програму.';
        $pageBlock->translateOrNew('ru')->title = 'Наші вакансії';
        $pageBlock->translateOrNew('ru')->description = 'Ми відкриті для співпраці зі страховими компаніями і партнерами по обслуговуванню Пацієнтів з добровільного медичного страхування. Якщо у Вас є поліс ДМС, Ви можете звернутися в свою страхову компанію і попросити додати нашу клініку в програму.';
        $pageBlock->translateOrNew('en')->title = 'Наші вакансії';
        $pageBlock->translateOrNew('en')->description = 'Ми відкриті для співпраці зі страховими компаніями і партнерами по обслуговуванню Пацієнтів з добровільного медичного страхування. Якщо у Вас є поліс ДМС, Ви можете звернутися в свою страхову компанію і попросити додати нашу клініку в програму.';

        $pageBlock->save();

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

        $page = Page::firstOrCreate([
            'type' => PageType::SHARES->value,
        ]);

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'main',
            'key' => 'slider',
        ]);

        $pageBlock->translateOrNew('ua')->title = 'Піклуєшся <br> про здоров’я?';
        $pageBlock->translateOrNew('ua')->description = 'Обери свій CHECK-UP!';
        $pageBlock->translateOrNew('ua')->button = 'Детальніше';
        $pageBlock->translateOrNew('ru')->title = 'Піклуєшся <br> про здоров’я?';
        $pageBlock->translateOrNew('ru')->description = 'Обери свій CHECK-UP!';
        $pageBlock->translateOrNew('ru')->button = 'Детальніше';
        $pageBlock->translateOrNew('en')->title = 'Піклуєшся <br> про здоров’я?';
        $pageBlock->translateOrNew('en')->description = 'Обери свій CHECK-UP!';
        $pageBlock->translateOrNew('en')->button = 'Детальніше';

        $pageBlock->save();

        $pageBlock2 = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'second',
            'key' => 'text',
        ]);

        $pageBlock2->translateOrNew('ua')->title = '“Check-up”
програми';
        $pageBlock2->translateOrNew('ua')->description = 'Комплексне обстеження та консультації фахівців';

        $pageBlock2->translateOrNew('ru')->title = '“Check-up”
програми';
        $pageBlock2->translateOrNew('ru')->description = 'Комплексне обстеження та консультації фахівців';

        $pageBlock2->translateOrNew('en')->title = '“Check-up”
програми';
        $pageBlock2->translateOrNew('en')->description = 'Комплексне обстеження та консультації фахівців';

        $pageBlock2->save();

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

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'conditions',
            'key' => 'title',
        ]);

        $pageBlock->translateOrNew('ua')->title = 'Умови перебування';
        $pageBlock->translateOrNew('ua')->button = 'Детальніше';
        $pageBlock->translateOrNew('ua')->description = 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officiis tempore maxime provident eos voluptatem. Et qui dicta molestiae animi laboriosam, repellendus sit quo quam doloremque veniam fugiat, facilis dolores voluptate. Excepturi culpa recusandae nisi incidunt ducimus ipsam modi officia laborum fugit unde eius dolorum commodi, voluptatem at neque placeat esse rem quidem maxime. Aspernatur obcaecati ipsam error, ullam dolorum tempora.';
        $pageBlock->translateOrNew('ru')->title = 'Умови перебування';
        $pageBlock->translateOrNew('ru')->button = 'Детальніше';
        $pageBlock->translateOrNew('ru')->description = 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officiis tempore maxime provident eos voluptatem. Et qui dicta molestiae animi laboriosam, repellendus sit quo quam doloremque veniam fugiat, facilis dolores voluptate. Excepturi culpa recusandae nisi incidunt ducimus ipsam modi officia laborum fugit unde eius dolorum commodi, voluptatem at neque placeat esse rem quidem maxime. Aspernatur obcaecati ipsam error, ullam dolorum tempora.';
        $pageBlock->translateOrNew('en')->title = 'Умови перебування';
        $pageBlock->translateOrNew('en')->button = 'Детальніше';
        $pageBlock->translateOrNew('en')->description = 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officiis tempore maxime provident eos voluptatem. Et qui dicta molestiae animi laboriosam, repellendus sit quo quam doloremque veniam fugiat, facilis dolores voluptate. Excepturi culpa recusandae nisi incidunt ducimus ipsam modi officia laborum fugit unde eius dolorum commodi, voluptatem at neque placeat esse rem quidem maxime. Aspernatur obcaecati ipsam error, ullam dolorum tempora.';

        $pageBlock->save();

        $pageBlock = PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => 'Inpatient',
            'key' => 'title',
        ]);

        $pageBlock->translateOrNew('ua')->title = 'Стаціонар';
        $pageBlock->translateOrNew('ua')->button = 'Детальніше';
        $pageBlock->translateOrNew('ua')->description = 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officiis tempore maxime provident eos voluptatem. Et qui dicta molestiae animi laboriosam, repellendus sit quo quam doloremque veniam fugiat, facilis dolores voluptate. Excepturi culpa recusandae nisi incidunt ducimus ipsam modi officia laborum fugit unde eius dolorum commodi, voluptatem at neque placeat esse rem quidem maxime. Aspernatur obcaecati ipsam error, ullam dolorum tempora.';
        $pageBlock->translateOrNew('ru')->title = 'Стаціонар';
        $pageBlock->translateOrNew('ru')->button = 'Детальніше';
        $pageBlock->translateOrNew('ru')->description = 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officiis tempore maxime provident eos voluptatem. Et qui dicta molestiae animi laboriosam, repellendus sit quo quam doloremque veniam fugiat, facilis dolores voluptate. Excepturi culpa recusandae nisi incidunt ducimus ipsam modi officia laborum fugit unde eius dolorum commodi, voluptatem at neque placeat esse rem quidem maxime. Aspernatur obcaecati ipsam error, ullam dolorum tempora.';
        $pageBlock->translateOrNew('en')->title = 'Стаціонар';
        $pageBlock->translateOrNew('en')->button = 'Детальніше';
        $pageBlock->translateOrNew('en')->description = 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officiis tempore maxime provident eos voluptatem. Et qui dicta molestiae animi laboriosam, repellendus sit quo quam doloremque veniam fugiat, facilis dolores voluptate. Excepturi culpa recusandae nisi incidunt ducimus ipsam modi officia laborum fugit unde eius dolorum commodi, voluptatem at neque placeat esse rem quidem maxime. Aspernatur obcaecati ipsam error, ullam dolorum tempora.';

        $pageBlock->save();

        PageBlock::firstOrCreate([
            'page_id' => $page->id,
            'block' => '3d',
            'key' => 'link',
        ]);

        Page::firstOrCreate([
            'type' => PageType::TEXT->value,
        ]);

        // pages in footer
        // $offerContract = Page::firstOrCreate([
        //     'type' => PageType::TEXT->value,
        //     'show_in_footer' => 1,
        //     'slug' => 'dohovir-oferty'
        // ]);
        // $offerContract->translateOrNew('ua')->title = 'Договір оферти';
        // $offerContract->translateOrNew('ru')->title = 'Договор оферты';
        // $offerContract->translateOrNew('en')->title = 'Offer contract';
        // $offerContract->save();

        // $videoSurveillance = Page::firstOrCreate([
        //     'type' => PageType::TEXT->value,
        //     'show_in_footer' => 1,
        //     'slug' => 'polozhennya-pro-videosposterezhennya-v-tsentri'
        // ]);
        // $videoSurveillance->translateOrNew('ua')->title = 'Положення про відеоспостереження в центрі';
        // $videoSurveillance->translateOrNew('ru')->title = 'Положение о видеонаблюдении в центре';
        // $videoSurveillance->translateOrNew('en')->title = 'Regulations on video surveillance in the center';
        // $videoSurveillance->save();

        // $airAlert = Page::firstOrCreate([
        //     'type' => PageType::TEXT->value,
        //     'show_in_footer' => 1,
        //     'slug' => 'pravyla-povedinky-pid-chas-povitryanoyi-tryvohy'
        // ]);
        // $airAlert->translateOrNew('ua')->title = 'Правила поведінки під час повітряної тривоги';
        // $airAlert->translateOrNew('ru')->title = 'Правила поведения во время воздушной тревоги';
        // $airAlert->translateOrNew('en')->title = 'Rules of conduct during an air alert';
        // $airAlert->save();

        // $processingPersonalData = Page::firstOrCreate([
        //     'type' => PageType::TEXT->value,
        //     'show_in_footer' => 1,
        //     'slug' => 'polozhennya-pro-protseduru-obrobky-personalnykh-danykh'
        // ]);
        // $processingPersonalData->translateOrNew('ua')->title = 'Положення про процедуру обробки персональних даних';
        // $processingPersonalData->translateOrNew('ru')->title = 'Положение о процедуре обработки персональных данных';
        // $processingPersonalData->translateOrNew('en')->title = 'Regulations on the procedure for processing personal data';
        // $processingPersonalData->save();


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
