<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Direction;

class DirectionsController extends Controller
{
    public function index()
    {
        return view('admin.directions.index');
    }

    public function edit(int $directionId)
    {
        $direction = Direction::find($directionId);

        switch ($direction->template) {
            case 1:
                return view('admin.directions.templates.category', compact('direction'));
                break;
            case 2:
                return view('admin.directions.templates.sub-category', compact('direction'));
                break;
            case 3:
                return view('admin.directions.templates.direction', compact('direction'));
                break;
        }
    }

}
