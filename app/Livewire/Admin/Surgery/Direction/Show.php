<?php

namespace App\Livewire\Admin\Surgery\Direction;

use App\Models\Surgery;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    use WithPagination;

    public Surgery $surgery;

    protected $listeners = [
        'refreshItemsAfterDelete' => 'refreshItemsAfterDelete',
        'refresh' => '$refresh',
    ];

    public function paginationView()
    {
        return 'vendor.pagination.tailwind';
    }

    public function mount(Surgery $surgery)
    {
        $this->surgery = $surgery;
    }

    public function render()
    {
        return view('livewire.admin.surgery.direction.show');
    }
}
