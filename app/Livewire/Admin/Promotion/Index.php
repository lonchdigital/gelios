<?php

namespace App\Livewire\Admin\Promotion;

use App\Enums\PageType;
use App\Models\Page;
use App\Models\Promotion;
use Livewire\Component;

class Index extends Component
{
    public Page $page2;

    public function mount()
    {
        $this->page2 = Page::where('type', PageType::SHARES->value)->first();
    }

    public function getPromotionsProperty()
    {
        $promotions = Promotion::get();

        return $promotions;
    }

    public function render()
    {
        return view('livewire.admin.promotion.index');
    }
}
