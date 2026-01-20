<?php

namespace App\Http\Controllers;

use App\Models\CourseApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('login', 'password');

        // Check if the credentials match the predefined admin
        if ($credentials['login'] === 'Admin' && $credentials['password'] === 'KorokNET') {
            // Create or find the admin user
            $admin = \App\Models\Admin::firstOrCreate(
                ['login' => 'Admin'],
                [
                    'name' => 'Admin',
                    'password' => \Illuminate\Support\Facades\Hash::make('KorokNET')
                ]
            );
            
            auth()->guard('admin')->login($admin);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['login' => 'Неверные учетные данные администратора']);
    }

    public function dashboard()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $applications = \App\Models\CourseApplication::all();
        return view('admin.dashboard', compact('applications'));
    }

    public function updateStatus(Request $request, \App\Models\CourseApplication $application)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        // Removed validation as per requirements
        $application->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Статус заявки обновлен');
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }
}