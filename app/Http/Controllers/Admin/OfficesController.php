<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class OfficesController extends Controller
{
    public function index()
    {
        return view('admin.offices.index');
    }

    public function createOffice()
    {
        $contact = null;
        return view('admin.offices.edit', compact('contact'));
    }
    public function editOffice(Contact $contact)
    {
        return view('admin.offices.edit', compact('contact'));
    }

}
