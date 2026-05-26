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

        // Users who completed the course and don't have any approved certificate yet
        $pendingUsers = User::where('status', 'active')
            ->whereNotNull('course_completed_at')
            ->whereDoesntHave('certificates', function($q) {
                $q->where('status', 'issued');
            })
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
            if ($exists->status === 'issued') {
                return back()->with('error', 'A certificate for this module has already been issued to this user.');
            }
            // If it exists but is pending, just approve it
            return $this->approveRequest($exists->id);
        }

        \Illuminate\Support\Facades\DB::transaction(function() use ($request) {
            $certificate = Certificate::create([
                'user_id'            => $request->user_id,
                'module_id'          => $request->module_id,
                'course_id'          => null,
                'certificate_number' => 'CERT-' . strtoupper(Str::random(10)),
                'issue_date'         => now(),
                'status'             => 'issued',
            ]);

            // Credit tokens since it is issued directly by admin
            $user = User::findOrFail($request->user_id);
            $this->creditNexa3Reward($user);
        });

        return redirect()->route('admin.certificates.issued')
                         ->with('success', 'Certificate issued & Nexa 3.0 tokens credited successfully!');
    }

    public function requests()
    {
        $requests = Certificate::with(['user', 'module'])->where('status', 'pending')->latest()->paginate(20);
        return view('admin.certificates.requests', compact('requests'));
    }

    public function approveRequest($id)
    {
        $cert = Certificate::findOrFail($id);
        
        if ($cert->status === 'issued') {
            return back()->with('error', 'This certificate has already been approved.');
        }

        \Illuminate\Support\Facades\DB::transaction(function() use ($cert) {
            $cert->update([
                'status' => 'issued',
                'issue_date' => now(),
            ]);

            $user = $cert->user;
            $this->creditNexa3Reward($user);

            \App\Models\ActivityLog::log('certificate_approved', "Approved certificate #{$cert->certificate_number} and credited Nexa 3.0 rewards to {$user->referral_code}.");
        });

        return back()->with('success', 'Certificate request approved & Nexa 3.0 tokens credited!');
    }

    public function rejectRequest($id)
    {
        $cert = Certificate::findOrFail($id);
        if ($cert->status === 'issued') {
            return back()->with('error', 'Cannot reject an already issued certificate.');
        }

        $user = $cert->user;
        \Illuminate\Support\Facades\DB::transaction(function() use ($cert, $user) {
            // Revert course_completed_at so they can complete again if needed
            $user->course_completed_at = null;
            $user->save();

            $cert->delete();
            \App\Models\ActivityLog::log('certificate_rejected', "Rejected certificate request for {$user->referral_code}.");
        });

        return back()->with('success', 'Certificate request rejected and deleted.');
    }

    protected function creditNexa3Reward($user)
    {
        $nexa3RewardAmount = (float) \App\Models\Setting::get('nexa_3_course_reward', 300);
        
        if ($nexa3RewardAmount > 0) {
            $wallet = \App\Models\Wallet::firstOrCreate(['user_id' => $user->id]);
            $wallet->nexa_3_wallet += $nexa3RewardAmount;
            $wallet->save();

            \App\Models\TokenLedger::create([
                'user_id' => $user->id,
                'token_type' => 'nexa_3',
                'token_count' => $nexa3RewardAmount,
                'token_value' => \App\Models\Setting::get('nexa_3_token_value', 1),
                'source' => 'Course Completion',
                'status' => 'credited',
                'credited_date' => now(),
            ]);
        }
    }

    public function issued(Request $request)
    {
        $q = $request->input('q');

        $certificates = Certificate::with(['user', 'module'])
            ->where('status', 'issued')
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

        $pendingCount = Certificate::where('status', 'pending')->count();

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
