<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CheckUp;
use App\Models\CheckUpProgram;
use Illuminate\Http\Request;

class CheckUpController extends Controller
{
    public function index()
    {
        return view('admin.check-up.index');
    }

    public function create()
    {
        return view('admin.check-up.create');
    }

    public function edit(CheckUp $checkUp)
    {
        return view('admin.check-up.edit', compact('checkUp'));
    }

    public function createProgram(CheckUp $checkUp)
    {
        return view('admin.check-up.create-program', compact('checkUp'));
    }

    public function editProgram(CheckUp $checkUp, CheckUpProgram $program)
    {
        return view('admin.check-up.edit-program', compact('checkUp', 'program'));
    }
}
