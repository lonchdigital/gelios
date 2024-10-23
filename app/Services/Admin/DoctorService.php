<?php

namespace App\Services\Admin;

use App\Models\Doctor;
use App\Models\DoctorTranslation;
use Illuminate\Support\Facades\Storage;

class DoctorService
{
    public function getDoctorTranslations(Doctor $doctor)
    {
        return DoctorTranslation::where('doctor_id', $doctor->id)
            ->get()
            ->keyBy('locale');
    }

    public function getDoctorImages(Doctor $doctor)
    {
        $images = [];
        foreach ($doctor->images ?? [] as $image) {
            $images[] = [
                'image' => $image,
                'imageUrl' => Storage::disk('public')->url($image),
            ];
        }
        return $images;
    }

    public function saveDoctor(Doctor $doctor, $slug, $age, $experience, $specialization, $category, $images)
    {
        $doctor->slug = $slug;
        $doctor->images = $images;
        $doctor->age = $age;
        $doctor->expirience = $experience;
        $doctor->specialization_id = $specialization;
        $doctor->doctor_category_id = $category;

        $doctor->save();

        return $doctor;
    }

    public function saveTranslations(Doctor $doctor, array $titles, array $descriptions, array $specialties, array $educations, array $locales)
    {
        foreach ($locales as $locale) {
            DoctorTranslation::updateOrCreate(
                [
                    'locale' => $locale,
                    'doctor_id' => $doctor->id,
                ],
                [
                    'title' => $titles[$locale],
                    'content' => $descriptions[$locale],
                    'specialty' => $specialties[$locale],
                    'education' => $educations[$locale],
                ]
            );
        }
    }
}

