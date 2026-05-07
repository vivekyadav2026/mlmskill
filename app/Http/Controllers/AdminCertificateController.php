<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Str;

class AdminCertificateController extends Controller
{
    public function generateForm()
    {
        $users = User::all();
        $courses = Course::all();
        return view('admin.certificates.generate', compact('users', 'courses'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        $exists = Certificate::where('user_id', $request->user_id)
                             ->where('course_id', $request->course_id)
                             ->first();
                             
        if ($exists) {
            return back()->with('error', 'Certificate already generated for this user and course.');
        }

        $certificate = Certificate::create([
            'user_id' => $request->user_id,
            'course_id' => $request->course_id,
            'certificate_number' => 'CERT-' . strtoupper(Str::random(10)),
            'issue_date' => now(),
            'status' => 'issued',
        ]);

        return redirect()->route('admin.certificates.issued')->with('success', 'Certificate generated successfully!');
    }

    public function issued()
    {
        $certificates = Certificate::with(['user', 'course'])->latest()->paginate(20);
        return view('admin.certificates.issued', compact('certificates'));
    }

    public function destroy($id)
    {
        $certificate = Certificate::findOrFail($id);
        $certificate->delete();
        return back()->with('success', 'Certificate deleted successfully.');
    }
}
