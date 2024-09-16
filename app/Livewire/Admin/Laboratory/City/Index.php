<?php

namespace App\Livewire\Admin\Laboratory\City;

use App\Models\LaboratoryCity;
use Livewire\Component;

class Index extends Component
{
    public function getCitiesProperty()
    {
        $cities = LaboratoryCity::paginate(10);

        return $cities;
    }

    public function render()
    {
        return view('livewire.admin.laboratory.city.index');
    }
}
