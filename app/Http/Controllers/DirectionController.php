<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Doctor;
use App\Enums\PageType;
use App\Models\Direction;
use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Models\PageDirection;
use App\Models\InsuranceCompany;

class DirectionController extends Controller
{

    public function page()
    {
        $page = Page::where('type', PageType::DIRECTIONS->value)->first();

        return view('site.directions.page',[
            'page' => $page,
        ]);
    }

    public function direction(PageDirection $pageDirection)
    {
        $direction = $pageDirection->direction;
        if( $direction->template !== 3 ) { abort(404); }

        $doctors = Doctor::limit(10)->get();
        $promotions = Promotion::limit(5)->get();

        return view('site.directions.direction',[
            'page' => $pageDirection,
            'direction' => $direction,
            'doctors' => $doctors,
            'promotions' => $promotions
        ]);
    }

    public function category(PageDirection $pageDirection)
    {
        $direction = $pageDirection->direction;
        if( $direction->template !== 1 ) { abort(404); }

        return view('site.directions.category',[
            'page' => $pageDirection,
            'direction' => $direction
        ]);
    }

    public function subCategory(PageDirection $pageDirection)
    {
        $direction = $pageDirection->direction;
        if( $direction->template !== 2 ) { abort(404); }

        $doctors = Doctor::limit(10)->get();

        return view('site.directions.sub-category',[
            'page' => $pageDirection,
            'direction' => $direction,
            'doctors' => $doctors
        ]);
    }
}
