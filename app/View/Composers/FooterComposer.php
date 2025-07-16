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
        $settings = Setting::with('translations')
            ->whereIn('key', [
                'footer_image',
                'footer_description',
                'facebook_link',
                'instagram_link',
                'youtube_link'
            ])->get()->keyBy('key');

        $footerInfos = FooterInfo::where('is_active', true)
            ->orderBy('sort', 'ASC')
            ->get();

        $footerDirections = FooterDirection::with('page', 'page.translations')
            ->whereHas('page', function ($q) {
                $q->where('in_footer', true);
            })->orderBy('sort', 'ASC')->get();

        $affiliates = HeaderAffiliate::with('translations')
            ->whereNull('header_city_id')->get();

        try {
            $view->with([
                'footerImage' => $settings['footer_image']->imageUrl ?? '',
                'description' => $settings['footer_description']->text ?? '',
                'facebook'    => $settings['facebook_link']->value ?? '',
                'instagram'   => $settings['instagram_link']->value ?? '',
                'youtube'     => $settings['youtube_link']->value ?? '',
                'infos'       => $footerInfos,
                'directions'  => $footerDirections,
                'affiliates'  => $affiliates,
            ]);
        } catch (\Exception $e) {
        }

    }
}
