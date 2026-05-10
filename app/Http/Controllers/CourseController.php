<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function my()
    {
        $user = Auth::user();
        
        // Fetch courses the user has access to (via CourseProgress which is created on purchase)
        $courseIds = \App\Models\CourseProgress::where('user_id', $user->id)->pluck('course_id');
        $courses = \App\Models\Course::whereIn('id', $courseIds)->where('status', 'active')->get();
        
        return view('user.course.my', compact('user', 'courses'));
    }

    public function progress()
    {
        $user = Auth::user();
        // Assuming progress is 100% if active
        $progress = $user->status === 'active' ? 100 : 0;
        return view('user.course.progress', compact('user', 'progress'));
    }

    public function completeView()
    {
        $user = Auth::user();
        $moduleName = 'Skill Development Program';
        $progress = \App\Models\CourseProgress::with('course.module')->where('user_id', $user->id)->first();
        
        if ($progress && $progress->course && $progress->course->module) {
            $moduleName = $progress->course->module->name;
        }

        return view('user.course.complete', compact('user', 'moduleName'));
    }

    public function markComplete()
    {
        $user = Auth::user();
        if ($user->status === 'active' && !$user->course_completed_at) {
            $user->course_completed_at = now();
            $user->save();
        }
        return redirect()->back()->with('success', 'Congratulations! Course marked as completed!');
    }

    public function certificate()
    {
        $user = Auth::user();
        
        $moduleName = 'Skill Development Program';
        $moduleDesc = 'various skill development mechanics and strategies';
        $progress = \App\Models\CourseProgress::with('course.module')->where('user_id', $user->id)->first();
        
        if ($progress && $progress->course && $progress->course->module) {
            $moduleName = $progress->course->module->name;
            $moduleDesc = $progress->course->module->description ?: 'skill development and associated mechanics';
        }
        
        return view('user.course.certificate', compact('user', 'moduleName', 'moduleDesc'));
    }
}
