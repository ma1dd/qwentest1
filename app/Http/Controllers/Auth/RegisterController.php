<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // No validation for registration as per requirements
        $data = $request->only(['name', 'email', 'login', 'phone']);
        $data['password'] = Hash::make($request->password);
        
        // Filter out null values to avoid database errors for non-nullable fields
        $user = User::create(array_filter($data, function($value) {
            return $value !== null;
        }));

        auth()->login($user);

        return redirect()->route('applications.index');
    }
}