<?php

namespace App\Services\Admin;

use App\Models\Doctor;
use App\Models\DoctorTranslation;
use App\Models\HeaderCity;
use App\Models\HeaderCityTranslation;
use Illuminate\Support\Facades\Storage;

class HeaderService
{
    public function saveCity(HeaderCity $city, $data, $phones)
    {
        $city->update($phones);

        HeaderCityTranslation::updateOrCreate([
            'header_city_id' => $city->id,
            'locale' => 'ua',
        ], [
            'title' => $data['ua']
        ]);

        HeaderCityTranslation::updateOrCreate([
            'header_city_id' => $city->id,
            'locale' => 'ru',
        ], [
            'title' => $data['ru']
        ]);

        HeaderCityTranslation::updateOrCreate([
            'header_city_id' => $city->id,
            'locale' => 'en',
        ], [
            'title' => $data['en']
        ]);
    }
}

