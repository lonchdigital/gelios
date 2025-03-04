<?php

namespace App\Livewire\Admin\Doctor;

use App\Models\Doctor;
use App\Services\Admin\DoctorService;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    protected $listeners = [
        'refreshItemsAfterDelete' => 'refreshItemsAfterDelete',
        'refresh' => '$refresh',
    ];

    public function getDoctorsProperty()
    {
        $doctors = Doctor::search(rtrim($this->search))
        ->paginate(10);

        return $doctors;
    }

    public function changeActive($id)
    {
        $service = resolve(DoctorService::class);

        $service->changeIsShowInMainPage($id);
    }

    public function deleteItem($id, $type)
    {
        $this->dispatch('openModalDeleteItem', $type, $id);
    }

    public function refreshItemsAfterDelete()
    {
        $this->dispatch('refresh');
    }

    public function render()
    {
        return view('livewire.admin.doctor.index');
    }
}
