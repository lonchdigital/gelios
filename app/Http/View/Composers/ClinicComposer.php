<?php

namespace App\Http\View\Composers;

use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\View\View;

class ClinicComposer
{
    protected $hospitals;

    public function __construct(Hospital $hospital)
    {
        $this->hospitals = $hospital;
    }

    public function compose(View $view)
    {
        $view->with('clinics', $this->hospitals->all());
    }
}
