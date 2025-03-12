<?php

namespace App\Services\Site;

use App\Models\Review;
use App\Models\VacancyApp;

class VacancyAppService
{
    public function store(array $data)
    {
        $data['status'] = 'new';
        $result = VacancyApp::create($data);

        return $result;
    }

}
