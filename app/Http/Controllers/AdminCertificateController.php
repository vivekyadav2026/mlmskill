<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\User;
use App\Models\CourseModule;
use Illuminate\Support\Str;

class AdminCertificateController extends Controller
{
    public function generateForm()
    {
        $modules = CourseModule::where('status', 'active')->orderBy('name')->get();

        // Users who completed the course and don't have any certificate yet
        $pendingUsers = User::where('status', 'active')
            ->whereNotNull('course_completed_at')
            ->whereDoesntHave('certificates')
            ->orderBy('course_completed_at', 'desc')
            ->get();

        // Pre-map users for JS (avoids Blade parse errors)
        $usersJson = User::where('status', 'active')->orderBy('name')->get()
            ->map(function ($u) {
                return [
                    'id'        => $u->id,
                    'name'      => $u->name,
                    'email'     => $u->email,
                    'code'      => $u->referral_code,
                    'completed' => (bool) $u->course_completed_at,
                ];
            })->values()->toArray();

        return view('admin.certificates.generate', compact('modules', 'pendingUsers', 'usersJson'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'user_id'   => 'required|exists:users,id',
            'module_id' => 'required|exists:course_modules,id',
        ]);

        $exists = Certificate::where('user_id', $request->user_id)
                             ->where('module_id', $request->module_id)
                             ->first();
        if ($exists) {
            return back()->with('error', 'A certificate for this module has already been issued to this user.');
        }

        $certificate = Certificate::create([
            'user_id'            => $request->user_id,
            'module_id'          => $request->module_id,
            'course_id'          => null,
            'certificate_number' => 'CERT-' . strtoupper(Str::random(10)),
            'issue_date'         => now(),
            'status'             => 'issued',
        ]);

        return redirect()->route('admin.certificates.issued')
                         ->with('success', 'Certificate issued successfully! #' . $certificate->certificate_number);
    }

    public function issued(Request $request)
    {
        $q = $request->input('q');

        $certificates = Certificate::with(['user', 'module'])
            ->when($q, function ($query) use ($q) {
                $query->where('certificate_number', 'like', "%$q%")
                      ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%$q%")
                                                         ->orWhere('email', 'like', "%$q%")
                                                         ->orWhere('referral_code', 'like', "%$q%"))
                      ->orWhereHas('module', fn($m) => $m->where('name', 'like', "%$q%"));
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $pendingCount = User::where('status', 'active')
            ->whereNotNull('course_completed_at')
            ->whereDoesntHave('certificates')
            ->count();

        return view('admin.certificates.issued', compact('certificates', 'q', 'pendingCount'));
    }

    public function preview($id)
    {
        $cert = Certificate::with(['user', 'module'])->findOrFail($id);
        return view('admin.certificates.preview', compact('cert'));
    }

    public function destroy($id)
    {
        Certificate::findOrFail($id)->delete();
        return back()->with('success', 'Certificate revoked and deleted.');
    }
}
