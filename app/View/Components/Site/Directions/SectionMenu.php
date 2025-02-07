<?php

namespace App\View\Components\Site\Directions;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SectionMenu extends Component
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function render(): View|Closure|string
    {
        return view('components.site.directions.section-menu', [
            'data' => $this->data
        ]);
    }
}