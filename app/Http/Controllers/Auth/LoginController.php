<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    
    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

    protected function redirectTo()
    {
        return '/admin';
    }
}
