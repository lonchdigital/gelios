<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Direction;
use Illuminate\Http\Request;
use App\Models\PageDirection;
use App\Models\InsuranceCompany;

class DirectionController extends Controller
{
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
