<?php

namespace App\View\Components\Admin\Directions;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DirectionChildren extends Component
{
    public $children;
    public $level;

    public function __construct($children, $level)
    {
        $this->children = $children;
        $this->level = $level;
    }

    public function render(): View|Closure|string
    {
        return view('components.admin.directions.direction-children', [
            'children' => $this->children,
            'level' => $this->level
        ]);
    }
}