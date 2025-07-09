<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Doctor;
use App\Models\Promotion;
use App\Models\PageDirection;
use App\Http\Controllers\Controller;

class WebPagesController extends Controller
{
    public function webPageByFullPath($slug) // full path slug
    {
        $url['ua'] = url('/') . '/ua/' . $slug;
        $url['ru'] = url('/') . '/' . $slug;
        $url['en'] = url('/') . '/en/' . $slug;

        $slugs = explode('/', $slug);
        $lastSlug = end($slugs);

        $page = PageDirection::where('slug', $lastSlug)->first();
        // $page = $this->getPageDirection($lastSlug, $slugs);

        if(!is_null($page)) {
            $direction = $page->direction;
            $directionSlugs = explode('/', $direction->buildFullPath());

            //$skipSlugCheck = ['']; // reproduktologiya
            // if (!in_array($lastSlug, $skipSlugCheck)) {
                
            // }

            if ($directionSlugs !== $slugs) {
                $locale = app()->getLocale();
                $localePrefix = $locale === 'ru' ? '' : '/' . $locale;
                $correctSlug = $direction->buildFullPath();

                return redirect()->to(url($localePrefix . '/' . $correctSlug));
            }

            switch ( $direction->template ) {
                case 1:

                    return view('site.directions.category',[
                        'page' => $page,
                        'direction' => $direction,
                        'url' => $url,
                    ]);

                    break;
                case 2:

                    return view('site.directions.sub-category',[
                        'page' => $page,
                        'direction' => $direction,
                        'doctors' => $direction->getDoctors(),
                        'url' => $url,
                    ]);

                    break;
                case 3:

                    return view('site.directions.direction',[
                        'page' => $page,
                        'direction' => $direction,
                        'doctors' => $direction->getDoctors(),
                        'promotions' => Promotion::limit(5)->get(),
                        'url' => $url,
                    ]);

                    break;
            }

            abort(404);

        } else {
            $page = Page::where('slug', $slug)->first();
            if(empty($page->type) || $page->type !== "text" ) { abort(404); }

            return view('site.text-pages.show', [
                'page' => $page,
                'url' => $url,
            ]);
        }

        abort(404);
    }

    public function webPageShow($slug)
    {
        $page = PageDirection::where('slug', $slug)->first();

        if(!is_null($page)) {
            $direction = $page->direction;

            switch ( $direction->template ) {
                case 1:

                    return view('site.directions.category',[
                        'page' => $page,
                        'direction' => $direction
                    ]);

                    break;
                case 2:

                    return view('site.directions.sub-category',[
                        'page' => $page,
                        'direction' => $direction,
                        'doctors' => Doctor::limit(10)->get()
                    ]);

                    break;
                case 3:

                    return view('site.directions.direction',[
                        'page' => $page,
                        'direction' => $direction,
                        'doctors' => Doctor::limit(10)->get(),
                        'promotions' => Promotion::limit(5)->get()
                    ]);

                    break;
            }

            abort(404);

        } else {
            $page = Page::where('slug', $slug)->first();
            if(empty($page->type) || $page->type !== "text" ) { abort(404); }

            return view('site.text-pages.show', [
                'page' => $page
            ]);
        }

        abort(404);
    }

}
