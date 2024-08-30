<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Page;
use Illuminate\Http\Request;

class InsuranceCompaniesController extends Controller
{
    public function index()
    {
        return view('admin.insurance-companies.index');
    }
}
