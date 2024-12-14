<?php

namespace Database\Seeders;

use App\Enums\PageType;
use App\Models\Page;
use Illuminate\Database\Seeder;

class AddPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Page::firstOrCreate([
            'type' => PageType::INSURANCECOMPANIES->value,
        ]);

    }
}
