<?php

namespace App\Livewire\Admin\Laboratory;

use App\Models\Laboratory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function getLaboratoriesProperty()
    {
        $laboratories = Laboratory::paginate(10);

        return $laboratories;
    }

    public function render()
    {
        return view('livewire.admin.laboratory.index');
    }
}
