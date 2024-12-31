<?php

namespace Database\Seeders;

use App\Enums\PageType;
use App\Models\HeaderAffiliate;
use App\Models\HeaderCity;
use App\Models\Page;
use App\Models\PageBlock;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeaderCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $city = HeaderCity::firstOrCreate([
        //     'first_phone' => '+38 (095) 000-01-50',
        //     'second_phone' => '+38 (050) 325-62-93',
        // ]);

        // $city->translateOrNew('ua')->title = "Дніпро";
        // $city->translateOrNew('ru')->title = "Днепр";
        // $city->translateOrNew('en')->title = "Dnipro";

        // $city->save();

        // $affiliate1 = HeaderAffiliate::create([
        //     'header_city_id' => $city->id,
        //     'first_phone' => '+38 (095) 000-01-50',
        //     'second_phone' => '+38 (050) 325-62-93',
        //     'hours' => '08:00 - 20:00',
        //     'email' => 'helioscentr@gmail.com',
        // ]);

        // $affiliate1->translateOrNew('ua')->address = "вул. Вернадського, 18а";
        // $affiliate1->translateOrNew('ru')->address = "вул. Вернадського, 18а";
        // $affiliate1->translateOrNew('en')->address = "вул. Вернадського, 18а";

        // $affiliate1->save();

        // $affiliate2 = HeaderAffiliate::create([
        //     'header_city_id' => $city->id,
        //     'first_phone' => '+38 (095) 000-01-50',
        //     'second_phone' => '+38 (050) 325-62-93',
        //     'hours' => '08:00 - 20:00',
        //     'email' => 'helioscentr@gmail.com',
        // ]);

        // $affiliate2->translateOrNew('ua')->address = "вул. Вернадського, 18а";
        // $affiliate2->translateOrNew('ru')->address = "вул. Вернадського, 18а";
        // $affiliate2->translateOrNew('en')->address = "вул. Вернадського, 18а";

        // $affiliate2->save();

        // $affiliate3 = HeaderAffiliate::create([
        //     'header_city_id' => $city->id,
        //     'first_phone' => '+38 (095) 000-01-50',
        //     'second_phone' => '+38 (050) 325-62-93',
        //     'hours' => '08:00 - 20:00',
        //     'email' => 'helioscentr@gmail.com',
        // ]);

        // $affiliate3->translateOrNew('ua')->address = "вул. Вернадського, 18а";
        // $affiliate3->translateOrNew('ru')->address = "вул. Вернадського, 18а";
        // $affiliate3->translateOrNew('en')->address = "вул. Вернадського, 18а";

        // $affiliate3->save();

        // $affiliate4 = HeaderAffiliate::create([
        //     'header_city_id' => $city->id,
        //     'first_phone' => '+38 (095) 000-01-50',
        //     'second_phone' => '+38 (050) 325-62-93',
        //     'hours' => '08:00 - 20:00',
        //     'email' => 'helioscentr@gmail.com',
        // ]);

        // $affiliate4->translateOrNew('ua')->address = "вул. Вернадського, 18а";
        // $affiliate4->translateOrNew('ru')->address = "вул. Вернадського, 18а";
        // $affiliate4->translateOrNew('en')->address = "вул. Вернадського, 18а";

        // $affiliate4->save();

        // $city2 = HeaderCity::firstOrCreate([
        //     'first_phone' => '+38 (050) 325-62-93',
        // ]);

        // $city2->translateOrNew('ua')->title = "Новомосковськ";
        // $city2->translateOrNew('en')->title = "Novomoskovsk";
        // $city2->translateOrNew('ru')->title = "Новомосковск";

        // $city2->save();

        // $affiliate1 = HeaderAffiliate::create([
        //     'header_city_id' => $city2->id,
        //     'first_phone' => '+38 (095) 000-01-50',
        //     'second_phone' => '+38 (050) 325-62-93',
        //     'hours' => '08:00 - 20:00',
        //     'email' => 'helioscentr@gmail.com',
        // ]);

        // $affiliate1->translateOrNew('ua')->address = "вул. Вернадського, 18а";
        // $affiliate1->translateOrNew('ru')->address = "вул. Вернадського, 18а";
        // $affiliate1->translateOrNew('en')->address = "вул. Вернадського, 18а";

        // $affiliate1->save();

        // $affiliate2 = HeaderAffiliate::create([
        //     'header_city_id' => $city2->id,
        //     'first_phone' => '+38 (095) 000-01-50',
        //     'second_phone' => '+38 (050) 325-62-93',
        //     'hours' => '08:00 - 20:00',
        //     'email' => 'helioscentr@gmail.com',
        // ]);

        // $affiliate2->translateOrNew('ua')->address = "вул. Вернадського, 18а";
        // $affiliate2->translateOrNew('ru')->address = "вул. Вернадського, 18а";
        // $affiliate2->translateOrNew('en')->address = "вул. Вернадського, 18а";

        // $affiliate2->save();

        // $affiliate3 = HeaderAffiliate::create([
        //     'header_city_id' => $city2->id,
        //     'first_phone' => '+38 (095) 000-01-50',
        //     'second_phone' => '+38 (050) 325-62-93',
        //     'hours' => '08:00 - 20:00',
        //     'email' => 'helioscentr@gmail.com',
        // ]);

        // $affiliate3->translateOrNew('ua')->address = "вул. Вернадського, 18а";
        // $affiliate3->translateOrNew('ru')->address = "вул. Вернадського, 18а";
        // $affiliate3->translateOrNew('en')->address = "вул. Вернадського, 18а";

        // $affiliate3->save();

        // $affiliate4 = HeaderAffiliate::create([
        //     'header_city_id' => $city2->id,
        //     'first_phone' => '+38 (095) 000-01-50',
        //     'second_phone' => '+38 (050) 325-62-93',
        //     'hours' => '08:00 - 20:00',
        //     'email' => 'helioscentr@gmail.com',
        // ]);

        // $affiliate4->translateOrNew('ua')->address = "вул. Вернадського, 18а";
        // $affiliate4->translateOrNew('ru')->address = "вул. Вернадського, 18а";
        // $affiliate4->translateOrNew('en')->address = "вул. Вернадського, 18а";

        // $affiliate4->save();
    }
}
