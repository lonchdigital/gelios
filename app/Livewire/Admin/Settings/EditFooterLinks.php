<?php

namespace App\Livewire\Admin\Settings;

use App\Enums\PageType;
use App\Models\FooterDirection;
use App\Models\FooterInfo;
use App\Models\Page;
use App\Services\Admin\FooterService;
use Livewire\Component;

class EditFooterLinks extends Component
{
    public function mount()
    {
        $service = resolve(FooterService::class);

        $service->loadInfo();

        $service->loadDirections();
    }

    public function getInfosProperty()
    {
        $pages = FooterInfo::orderBy('sort', 'ASC')
            ->get();

        return $pages;
    }

    public function getDirectionsProperty()
    {
        $directions = FooterDirection::whereHas('page', function($q) {
            $q->where('in_footer', true);
        })
            ->orderBy('sort', 'ASC')
            ->get();

        return $directions;
    }

    public function newPosition($val, FooterInfo $info)
    {
        $service = resolve(FooterService::class);

        $service->updatePosition($info, $val);
    }

    public function changeIsActive(FooterInfo $info)
    {
        $service = resolve(FooterService::class);

        $service->updateIsActive($info);
    }

    public function newDirectionPosition($val, FooterDirection $direction)
    {
        $service = resolve(FooterService::class);

        $service->updateDirectionPosition($direction, $val);
    }

    public function changeDirectionIsActive(FooterDirection $direction)
    {
        $service = resolve(FooterService::class);

        $service->updateDirectionIsActive($direction);
    }

    public function render()
    {
        return view('livewire.admin.settings.edit-footer-links');
    }
}
