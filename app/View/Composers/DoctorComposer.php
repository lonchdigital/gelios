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
                'doctors'       => Specialization::join('specialization_translations as t', function ($join) {
                                            $join->on('specializations.id', '=', 't.specialization_id')
                                                ->where('t.locale', '=', 'ua');
                                        })
                                        ->orderBy('t.title')
                                        ->select('specializations.*')
                                        ->get(),
                'clinics'       => Contact::get(),
            ]);
        } catch (\Exception $e) {
        }

    }
}
