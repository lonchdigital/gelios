<?php

namespace App\Http\View\Composers;

use App\Models\Doctor;
use Illuminate\View\View;

class DoctorComposer
{
    protected $doctors;

    public function __construct(Doctor $doctors)
    {
        $this->doctors = $doctors;
    }

    public function compose(View $view)
    {
        $view->with('doctors', $this->doctors->all());
    }
}
