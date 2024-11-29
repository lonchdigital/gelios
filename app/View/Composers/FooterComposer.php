<?php

namespace App\View\Composers;

use App\Models\FooterDirection;
use App\Models\FooterInfo;
use App\Models\HeaderAffiliate;
use App\Models\Setting;
use Illuminate\View\View;

class FooterComposer
{
    public function compose(View $view)
    {
        try {
            $view->with([
                'footerImage'       => Setting::where('key', 'footer_image')->first()->imageUrl ?? '',
                'description'       => Setting::where('key', 'footer_description')->first()->text ?? '',
                'facebook'          => Setting::where('key', 'facebook_link')->first()->value ?? '',
                'instagram'         => Setting::where('key', 'instagram_link')->first()->value ?? '',
                'youtube'           => Setting::where('key', 'youtube_link')->first()->value ?? '',
                'infos'             => FooterInfo::where('is_active', true)->orderBy('sort', 'ASC')->get(),
                'directions'        => FooterDirection::where('is_active', true)->orderBy('sort', 'ASC')->get(),
                'affiliates'        => HeaderAffiliate::where('header_city_id', null)->get(),
            ]);
        } catch (\Exception $e) {
        }

    }
}
