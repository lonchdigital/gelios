<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InsuranceCompany;

class HomeController extends Controller
{
    public function index()
    {
        return view('site.pages.main',[
            'insuranceCompanies' => InsuranceCompany::all()
        ]);
    }
}
