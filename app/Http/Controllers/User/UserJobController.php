<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserJobController extends Controller
{
    public function index()
    {
        $jobs = JobPosting::where('status', 'active')->latest()->paginate(12);
        return view('user.jobs.index', compact('jobs'));
    }

    public function show($id)
    {
        $job = JobPosting::findOrFail($id);
        $alreadyApplied = JobApplication::where('user_id', Auth::id())->where('job_posting_id', $id)->exists();
        return view('user.jobs.show', compact('job', 'alreadyApplied'));
    }

    public function apply(Request $request, $id)
    {
        $job = JobPosting::findOrFail($id);
        
        // Prevent double application
        if (JobApplication::where('user_id', Auth::id())->where('job_posting_id', $id)->exists()) {
            return back()->with('error', 'You have already applied for this position.');
        }

        $request->validate([
            'resume' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        $resumePath = null;
        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        }

        JobApplication::create([
            'user_id' => Auth::id(),
            'job_posting_id' => $id,
            'resume_path' => $resumePath,
            'cover_letter' => $request->cover_letter,
            'status' => 'pending'
        ]);

        return redirect()->route('user.jobs.applications')->with('success', 'Application submitted successfully!');
    }

    public function applications()
    {
        $applications = JobApplication::with('job')->where('user_id', Auth::id())->latest()->get();
        return view('user.jobs.applications', compact('applications'));
    }
}
