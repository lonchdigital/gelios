<?php

namespace App\Livewire\Admin\CheckUp;

use App\Enums\PageType;
use App\Models\CheckUp;
use App\Models\Page;
use Livewire\Component;

class Index extends Component
{
    public function getCheckupsProperty()
    {
        $checkups = CheckUp::paginate(10);

        return $checkups;
    }

    public function render()
    {
        return view('livewire.admin.check-up.index');
    }
}
