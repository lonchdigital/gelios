<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;

class CommonBlocksController extends Controller
{
    public function directions()
    {
        return view('admin.common-blocks.directions');
    }


}
