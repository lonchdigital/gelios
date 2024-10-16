<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('admin.contacts.index');
    }

    public function createContact()
    {
        $contact = null;
        return view('admin.contacts.edit', compact('contact'));
    }
    public function editContact(Contact $contact)
    {
        return view('admin.contacts.edit', compact('contact'));
    }

}
