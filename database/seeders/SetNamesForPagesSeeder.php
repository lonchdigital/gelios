<?php

namespace Database\Seeders;

use App\Enums\PageType;
use App\Models\Page;
use App\Models\PageBlock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SetNamesForPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $surgery = Page::firstOrCreate([
            'type' => PageType::SURGERY->value,
        ]);

        $surgery->update([
            'ua' => ['title' => 'Хірургія'],
            'ru' => ['title' => 'Хирургия'],
            'en' => ['title' => 'Surgery'],
        ]);

    }
}
