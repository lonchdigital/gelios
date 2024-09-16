<?php

namespace App\Livewire\Admin\DoctorCategory;

use App\Models\DoctorCategory;
use Livewire\Component;

class Index extends Component
{
    public function getCategoriesProperty()
    {
        $categories = DoctorCategory::paginate(10);

        return $categories;
    }

    public function render()
    {
        return view('livewire.admin.doctor-category.index');
    }
}
