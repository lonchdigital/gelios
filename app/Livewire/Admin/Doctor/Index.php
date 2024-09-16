<?php

namespace App\Livewire\Admin\Doctor;

use App\Models\Doctor;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function getDoctorsProperty()
    {
        $doctors = Doctor::paginate(10);

        return $doctors;
    }

    public function render()
    {
        return view('livewire.admin.doctor.index');
    }
}
