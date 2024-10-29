<?php

namespace Database\Seeders;

use App\Enums\PageType;
use App\Models\Page;
use App\Models\PageBlock;
use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::firstOrCreate([
            'key' => 'header_image',
        ]);

        Setting::firstOrCreate([
            'key' => 'footer_image',
        ]);

        $setting = Setting::firstOrCreate([
            'key' => 'footer_description',
        ]);

        $setting->translateOrNew('ua')->text = "Медичний центр сімейного здоров'я та реабілітації Геліос - це сучасне обладнання, кваліфіковані лікарі, індивідуальний підхід до кожного пацієнта.";
        $setting->translateOrNew('en')->text = "Medical Center for Family Health and Rehabilitation Helios - modern equipment, qualified doctors, and an individual approach to each patient.";
        $setting->translateOrNew('ru')->text = "Медицинский центр семейного здоровья и реабилитации Гелиос - это современное оборудование, квалифицированные врачи и индивидуальный подход к каждому пациенту.";

        $setting->save();

        Setting::firstOrCreate([
            'key' => 'facebook_link',
        ]);

        Setting::firstOrCreate([
            'key' => 'instagram_link',
        ]);

        Setting::firstOrCreate([
            'key' => 'youtube_link',
        ]);
    }
}
