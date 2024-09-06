<?php

namespace App\Livewire\Admin\Promotion;

use App\Models\Promotion;
use Livewire\Component;

class Index extends Component
{
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
