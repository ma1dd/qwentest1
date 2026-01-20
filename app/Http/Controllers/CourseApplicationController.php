<?php

namespace App\Http\Controllers;

use App\Models\CourseApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseApplicationController extends Controller
{
    public function index()
    {
        $applications = CourseApplication::where('user_id', Auth::id())->get();
        return view('applications.index', compact('applications'));
    }

    public function create()
    {
        return view('applications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_name' => 'required|string|max:255',
            'start_date' => 'required|date|after:today',
            'payment_method' => 'required|in:cash,phone'
        ]);

        CourseApplication::create([
            'user_id' => Auth::id(),
            'course_name' => $request->course_name,
            'start_date' => $request->start_date,
            'payment_method' => $request->payment_method,
            'status' => 'new'
        ]);

        return redirect()->route('applications.index')->with('success', 'Заявка успешно отправлена!');
    }

    public function updateReview(Request $request, CourseApplication $application)
    {
        $request->validate([
            'review' => 'required|string|max:1000'
        ]);

        $application->update(['review' => $request->review]);

        return redirect()->back()->with('success', 'Отзыв успешно сохранен!');
    }
}