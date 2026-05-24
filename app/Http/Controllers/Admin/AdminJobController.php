<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class AdminJobController extends Controller
{
    public function index()
    {
        $jobs = JobPosting::withCount('applications')->latest()->paginate(15);
        return view('admin.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:job,company_placement',
            'job_type' => 'required|in:full_time,part_time,internship,contract',
        ]);

        JobPosting::create($request->all());

        return redirect()->route('admin.jobs.index')->with('success', 'Job/Placement posted successfully!');
    }

    public function edit($id)
    {
        $job = JobPosting::findOrFail($id);
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|in:job,company_placement',
            'job_type' => 'required|in:full_time,part_time,internship,contract',
            'status' => 'required|in:active,inactive',
        ]);

        $job = JobPosting::findOrFail($id);
        $job->update($request->all());

        return redirect()->route('admin.jobs.index')->with('success', 'Job/Placement updated successfully!');
    }

    public function destroy($id)
    {
        $job = JobPosting::findOrFail($id);
        $job->delete();

        return redirect()->route('admin.jobs.index')->with('success', 'Job/Placement deleted successfully!');
    }

    public function applications()
    {
        $applications = JobApplication::with(['user', 'job'])->latest()->paginate(20);
        return view('admin.jobs.applications', compact('applications'));
    }

    public function updateApplication(Request $request, $id)
    {
        $app = JobApplication::findOrFail($id);
        $app->update([
            'status' => $request->status,
            'admin_remarks' => $request->admin_remarks
        ]);

        return back()->with('success', 'Application status updated!');
    }
}
