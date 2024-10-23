<?php

namespace App\Services\Admin;

use App\Models\Specialization;
use App\Models\SpecializationTranslation;

class SpecializationService
{
    public function getTranslations($specializationId)
    {
        return SpecializationTranslation::where('specialization_id', $specializationId)
            ->get()
            ->keyBy('locale');
    }

    public function saveSpecialization(Specialization $specialization, array $titles)
    {
        $specialization->save();

        foreach ($titles as $locale => $title) {
            SpecializationTranslation::updateOrCreate(
                [
                    'locale' => $locale,
                    'specialization_id' => $specialization->id,
                ],
                [
                    'title' => $title,
                ]
            );
        }
    }
}
