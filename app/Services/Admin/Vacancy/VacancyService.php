<?php

namespace App\Services\Admin\Vacancy;

use App\Models\PageBlock;
use App\Models\PageBlockTranslation;
use App\Models\Vacancy;
use App\Models\VacancyTranslation;

class VacancyService
{
    public function getTranslations(Vacancy $vacancy)
    {
        return VacancyTranslation::where('vacancy_id', $vacancy->id)
            ->get()
            ->keyBy('locale');
    }
}