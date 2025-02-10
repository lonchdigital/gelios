<?php

namespace Database\Seeders;

use App\Enums\PageType;
use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaboratoryPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $page6 = Page::firstOrCreate([
            'type' => PageType::LABORATORYPRICE->value,
        ]);

        $page6->update([
            'slug' => 'prices'
        ]);

        $page6->translateOrNew('ua')->title = 'Ціни';
        $page6->translateOrNew('ru')->title = 'Ціни';
        $page6->translateOrNew('en')->title = 'Prices';

        $page6->save();
    }
}
