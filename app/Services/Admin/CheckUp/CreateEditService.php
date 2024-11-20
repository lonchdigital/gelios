<?php

namespace App\Services\Admin\CheckUp;

use App\Models\CheckUpProgramTranslation;
use App\Models\CheckUpTranslation;

class CreateEditService
{
    public function getTranslations($checkUpId, array $locales)
    {
        $translations = [];
        foreach ($locales as $locale) {
            $translation = CheckUpTranslation::where('locale', $locale)
                ->where('check_up_id', $checkUpId)
                ->first();

            $translations[$locale] = [
                'title' => $translation->title ?? '',
                'description' => $translation->description ?? '',
                'slug' => $translation->slug ?? '',
            ];
        }

        return $translations;
    }

    public function saveTranslations($checkUpId, array $translations)
    {
        foreach ($translations as $locale => $data) {
            CheckUpTranslation::updateOrCreate(
                [
                    'locale' => $locale,
                    'check_up_id' => $checkUpId,
                ],
                [
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'slug' => $data['slug'],
                ]
            );
        }
    }

    public function saveProgramTranslations($program, $locales, $titles, $optionsArray)
    {
        foreach ($locales as $locale) {
            CheckUpProgramTranslation::updateOrCreate(
                [
                    'locale' => $locale,
                    'check_up_program_id' => $program->id,
                ],
                [
                    'title' => $titles[$locale],
                    'options' => $optionsArray[$locale],
                ]
            );
        }
    }

    public function prepareOptionsArray($options, $locales)
    {
        $optionsArray = array_fill_keys($locales, []);

        foreach ($options as $option) {
            foreach ($locales as $locale) {
                $optionsArray[$locale][] = $option[$locale] ?? '';
            }
        }

        return $optionsArray;
    }
}
