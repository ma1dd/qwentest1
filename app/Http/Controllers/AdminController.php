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

        // Проверяем учетные данные администратора
        if ($credentials['login'] === 'Admin' && Hash::check($request->password, Hash::make('KorokNET'))) {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['login' => 'Неверные учетные данные администратора']);
    }

    public function dashboard()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $applications = CourseApplication::all();
        return view('admin.dashboard', compact('applications'));
    }

    public function updateStatus(Request $request, CourseApplication $application)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $request->validate([
            'status' => 'required|in:new,in_progress,completed'
        ]);

        $application->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Статус заявки обновлен');
    }

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }
}