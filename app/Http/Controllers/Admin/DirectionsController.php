<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Direction;

class DirectionsController extends Controller
{
    public function index()
    {
        return view('admin.directions.index', ['direction' => null]);
    }

    public function category(int $directionId)
    {
        $direction = Direction::find($directionId);

        return view('admin.directions.index', compact('direction'));
    }

    public function edit(int $directionId)
    {
        $direction = Direction::find($directionId);

        if(!is_null($direction)) {
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
        } else {
            return view('admin.directions.index');
        }
    }

}
