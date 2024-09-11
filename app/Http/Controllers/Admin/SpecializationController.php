<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    public function index()
    {
        return view('admin.specialization.index');
    }

    public function create()
    {
        return view('admin.specialization.create');
    }

    public function edit(Specialization $specalization)
    {
        return view('admin.specialization.edit', compact('specalization'));
    }
}
