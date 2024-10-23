<?php

namespace App\Services\Admin\Surgery;

use App\Models\Surgery;
use App\Models\SurgeryTranslation;

class DirectionService
{
    public function getSurgeryTranslations(Surgery $surgery)
    {
        $translations = SurgeryTranslation::where('surgery_id', $surgery->id)
            ->get()
            ->keyBy('locale');

        return [
            'uaTitle' => $translations['ua']->title ?? '',
            'enTitle' => $translations['en']->title ?? '',
            'ruTitle' => $translations['ru']->title ?? '',
        ];
    }

    public function saveSurgery(Surgery $surgery, array $translations)
    {
        $surgery->save();

        foreach ($translations as $locale => $title) {
            SurgeryTranslation::updateOrCreate([
                'locale' => $locale,
                'surgery_id' => $surgery->id,
            ], [
                'title' => $title,
            ]);
        }
    }
}

