<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use Illuminate\Http\Request;
use App\Models\InsuranceCompany;
use App\Models\PageDirection;

class DirectionController extends Controller
{
    public function category(PageDirection $pageDirection)
    {
        return view('site.directions.category',[
            'page' => $pageDirection,
            'direction' => $pageDirection->direction
        ]);
    }
}
