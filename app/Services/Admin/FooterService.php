<?php

namespace App\Services\Admin;

use App\Enums\PageType;
use App\Models\ArticleBlock;
use App\Models\ArticleTranslation;
use App\Models\Direction;
use App\Models\FooterDirection;
use App\Models\FooterInfo;
use App\Models\Page;
use App\Models\PageDirection;

class FooterService
{
    public function updatePosition(FooterInfo $block, $val)
    {
        $currentSort = $block->sort;
        $newSort = $currentSort + $val;

        FooterInfo::where('sort', $newSort)->first()->update([
            'sort' => $currentSort,
        ]);

        $block->update([
            'sort' => $newSort,
        ]);
    }

    public function updateIsActive(FooterInfo $info)
    {
        $info->update([
            'is_active' => !$info->is_active,
        ]);
    }

    public function loadInfo()
    {
        $pages = Page::whereIn('type', [
            PageType::HOSPITAL->value,
            PageType::PRICES->value,
            PageType::CONTACTS->value,
            PageType::BLOG->value,
            PageType::SHARES->value,
            PageType::DOCTOR->value,
            PageType::ABOUT->value,
            PageType::LABORATORY->value,
            PageType::INSURANCECOMPANIES->value,
            PageType::REVIEWS->value,
            PageType::PRICES->value,
            PageType::OFFICES->value,
            PageType::CHECKUP->value,
            PageType::SURGERY->value,
            PageType::OPENING->value,

        ])
            ->get();

        foreach ($pages as $page) {
            FooterInfo::firstOrCreate([
                'page_id' => $page->id
            ], [
                'is_active' => true,
            ]);
        }

        $infos = FooterInfo::orderBy('sort', 'ASC')
            ->get();

        $i = 1;

        foreach($infos as $info) {
            $info->update([
                'sort' => $i
            ]);

            $i++;
        }
    }

    public function updateDirectionPosition(FooterDirection $block, $val)
    {
        $currentSort = $block->sort;
        $newSort = $currentSort + $val;

        FooterDirection::where('sort', $newSort)->first()->update([
            'sort' => $currentSort,
        ]);

        $block->update([
            'sort' => $newSort,
        ]);
    }

    public function updateDirectionIsActive(FooterDirection $info)
    {
        $info->update([
            'is_active' => !$info->is_active,
        ]);
    }

    public function loadDirections()
    {
        $directions = Direction::get();

        foreach ($directions as $page) {
            FooterDirection::firstOrCreate([
                'page_direction_id' => $page->id
            ], [
                'is_active' => true,
            ]);
        }

        $infos = FooterDirection::orderBy('sort', 'ASC')
            ->get();

        $i = 1;

        foreach($infos as $info) {
            $info->update([
                'sort' => $i
            ]);

            $i++;
        }
    }
}
