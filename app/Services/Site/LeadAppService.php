<?php

namespace App\Services\Site;

use App\Models\LeadRequest;

class LeadAppService
{
    public function store(array $data)
    {
        $data['status'] = 'new';
        $result = LeadRequest::create($data);

        return $result;
    }

}
