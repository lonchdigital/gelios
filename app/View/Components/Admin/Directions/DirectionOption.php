<?php

namespace App\View\Components\Admin\Directions;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DirectionOption extends Component
{
    public $direction;
    public $depth;

    public function __construct($direction, $depth)
    {
        $this->direction = $direction;
        $this->depth = $depth;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.directions.direction-option', [
            'direction' => $this->direction,
            'depth' => $this->depth
        ]);
    }
}