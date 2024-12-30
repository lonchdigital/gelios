<?php

namespace App\View\Composers;

use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Setting;
use Illuminate\View\View;

class DoctorComposer
{
    public function compose(View $view)
    {
        try {
            $view->with([
                'doctors'       => Doctor::get(),
                'clinics'       => Hospital::get(),
            ]);
        } catch (\Exception $e) {
        }

    }
}
