<?php

namespace App\Services\Site;

use Illuminate\Http\Request;


class MetaService
{
    public function getMeta($slug, $templateTitle, $templateDescription)
    {
        $templateTitle = str_replace('%title%', $slug, $templateTitle);
        $templateDescription = str_replace('%title%', $slug, $templateDescription);

        return [$templateTitle, $templateDescription];
    }
}
