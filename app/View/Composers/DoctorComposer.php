<?php

namespace App\View\Composers;

use App\Models\Contact;
use App\Models\Doctor;
use App\Models\DoctorSpecialization;
use App\Models\Hospital;
use App\Models\Setting;
use App\Models\Specialization;
use Illuminate\View\View;

class DoctorComposer
{
    public function compose(View $view)
    {
        try {
            $view->with([
                'doctors'       => Specialization::get(),
                'clinics'       => Contact::get(),
            ]);
        } catch (\Exception $e) {
        }

    }
}
