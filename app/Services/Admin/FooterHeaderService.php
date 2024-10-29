<?php

namespace App\Services\Admin;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Collection;

class FooterHeaderService
{
    public function loadSettings()
    {
        $settings = Setting::whereIn('key', [
            'header_image',
            'footer_image',
            'footer_description',
            'facebook_link',
            'youtube_link',
            'instagram_link',
        ])->get();

        return $settings;
    }
}
