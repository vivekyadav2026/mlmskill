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

        // 1-year course completion validity check
        $activationDate = $user->activation_date;
        $canComplete = false;
        $daysRemaining = 0;

        if ($activationDate) {
            $completionDate = $activationDate->copy()->addYear();
            if (now()->greaterThanOrEqualTo($completionDate)) {
                $canComplete = true;
            } else {
                $daysRemaining = now()->diffInDays($completionDate, false);
            }
        }

        $pendingCertificate = \App\Models\Certificate::where('user_id', $user->id)->where('status', 'pending')->first();

        return view('user.course.complete', compact('user', 'moduleName', 'canComplete', 'daysRemaining', 'pendingCertificate'));
    }

    public function markComplete()
    {
        $user = Auth::user();

        // Enforce 1 year validity rule
        $activationDate = $user->activation_date;
        if (!$activationDate) {
            return redirect()->back()->with('error', 'Your account activation date is not set.');
        }

        $completionDate = $activationDate->copy()->addYear();
        if (now()->lessThan($completionDate)) {
            $daysRemaining = now()->diffInDays($completionDate, false);
            return redirect()->back()->with('error', "You cannot complete this course yet. You must wait {$daysRemaining} more days (1 year completion validity rule).");
        }

        if ($user->status === 'active' && !$user->course_completed_at) {
            $user->course_completed_at = now();
            $user->save();

            // Create a pending certificate request instead of crediting tokens immediately
            $progress = \App\Models\CourseProgress::with('course.module')->where('user_id', $user->id)->first();
            $moduleId = $progress->course->module_id ?? null;

            \App\Models\Certificate::firstOrCreate([
                'user_id' => $user->id,
                'module_id' => $moduleId,
            ], [
                'certificate_number' => 'CERT-' . strtoupper(\Illuminate\Support\Str::random(10)),
                'status' => 'pending',
                'issue_date' => null,
            ]);

            \App\Models\ActivityLog::log('course_completion_requested', "User {$user->referral_code} requested course completion. Certificate approval is pending.");
        }
        return redirect()->back()->with('success', 'Course marked as completed! Your certificate is pending admin approval. Nexa 3.0 tokens will be credited upon approval.');
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

        // Check if an approved certificate exists
        $certificate = \App\Models\Certificate::where('user_id', $user->id)->where('status', 'issued')->first();
        
        return view('user.course.certificate', compact('user', 'moduleName', 'moduleDesc', 'certificate'));
    }
}
