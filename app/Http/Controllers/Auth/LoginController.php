<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Removed validation as per consistency with registration
        $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'login';
        
        $credentials = [
            $login_type => $request->login,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('applications');
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ]);
    }
}