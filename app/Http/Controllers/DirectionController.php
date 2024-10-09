<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Direction;
use Illuminate\Http\Request;
use App\Models\PageDirection;
use App\Models\InsuranceCompany;
use App\Models\Promotion;

class DirectionController extends Controller
{
    public function direction(PageDirection $pageDirection)
    {
        $doctors = Doctor::limit(10)->get();
        $promotions = Promotion::limit(5)->get();

        return view('site.directions.direction',[
            'page' => $pageDirection,
            'direction' => $pageDirection->direction,
            'doctors' => $doctors,
            'promotions' => $promotions
        ]);
    }

    public function category(PageDirection $pageDirection)
    {
        return view('site.directions.category',[
            'page' => $pageDirection,
            'direction' => $pageDirection->direction
        ]);
    }

    public function subCategory(PageDirection $pageDirection)
    {
        $doctors = Doctor::limit(10)->get();

        return view('site.directions.sub-category',[
            'page' => $pageDirection,
            'direction' => $pageDirection->direction,
            'doctors' => $doctors
        ]);
    }
}
