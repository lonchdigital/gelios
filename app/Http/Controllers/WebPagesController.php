<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Doctor;
use App\Models\Promotion;
use App\Models\PageDirection;
use App\Http\Controllers\Controller;

class WebPagesController extends Controller
{

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
            if( $page->type !== "text" ) { abort(404); }

            return view('site.text-pages.show', [
                'page' => $page
            ]);
        }

        abort(404);
    }

}