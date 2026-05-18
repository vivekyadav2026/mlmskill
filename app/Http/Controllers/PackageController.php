<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    public function upgrade()
    {
        $user = Auth::user();
        $balance = $user->wallet->package_wallet ?? 0;
        
        // Fetch all active modules with their courses
        $modules = \App\Models\CourseModule::with('courses')->where('status', 'active')->get();
        
        // Get IDs of courses the user already owns (if needed for checking)
        $purchasedCourseIds = \App\Models\CourseProgress::where('user_id', $user->id)
                                ->pluck('course_id')->toArray();
                                
        return view('user.package.upgrade', compact('user', 'balance', 'modules', 'purchasedCourseIds'));
    }

    public function checkout($id)
    {
        $user = Auth::user();
        if ($user->status === 'active') {
            return redirect()->route('dashboard')->with('error', 'Your account is already active.');
        }

        $module = \App\Models\CourseModule::with('courses')->findOrFail($id);
        $balance = $user->wallet->package_wallet ?? 0;
        
        // Use user's referral code as the ID to share with someone else for activation
        $sponsorId = $user->referral_code;

        return view('user.package.checkout', compact('user', 'module', 'balance', 'sponsorId'));
    }

    public function history()
    {
        $user = Auth::user();
        
        $history = \App\Models\ActivityLog::where('user_id', $user->id)
            ->whereIn('action', ['account_activated', 'account_activated_by_sponsor'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('user.package.history', compact('user', 'history'));
    }

    public function purchase(Request $request, \App\Services\CommissionService $commissionService)
    {
        $user = Auth::user();
        
        if ($user->status === 'active') {
            return back()->with('error', 'Your account is already active.');
        }

        $request->validate([
            'module_id' => 'required|exists:course_modules,id'
        ]);

        $wallet = $user->wallet;
        $price = 300.00; // NGO Sponsored Price for any module

        if (!$wallet || $wallet->package_wallet < $price) {
            return back()->with('error', 'Insufficient funds in your Package Wallet. You need $300.');
        }

        // Deduct from wallet
        $wallet->decrement('package_wallet', $price);

        // Get the selected module
        $module = \App\Models\CourseModule::with('courses')->findOrFail($request->module_id);

        // Grant access to all courses inside this module
        foreach ($module->courses as $course) {
            if ($course->status == 'active') {
                \App\Models\CourseProgress::firstOrCreate([
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                ]);
            }
        }

        // Activate User
        $user->status = 'active';
        $user->activation_date = now();
        $user->save();

        // Distribute upline commissions
        $commissionService->distributeCommissions($user, $price);

        // Check for Reward Income milestones
        app(\App\Services\BonusService::class)->checkAndDistributeRewardIncome($user);

        // Give 300 free NEXA 1.0 upon activation
        $tokenValue = (float) \App\Models\Setting::get('utility_token_value', 0.10);
        \App\Models\TokenLedger::create([
            'user_id' => $user->id,
            'token_type' => 'utility',
            'token_count' => 300,
            'token_value' => $tokenValue,
            'source' => 'activation_bonus',
            'status' => 'credited',
            'credited_date' => now(),
        ]);
        $wallet->increment('utility_token_wallet', 300);

        \App\Models\ActivityLog::log('account_activated', 'Activated account with NGO Package for $' . $price, $user->id);

        return redirect()->route('dashboard')->with('success', 'Account activated successfully! You now have full access to the platform and courses.');
    }

    public function activateMember()
    {
        $user = Auth::user();
        $balance = $user->wallet->package_wallet ?? 0;
        
        $modules = \App\Models\CourseModule::where('status', 'active')->get();
        return view('user.package.activate_member', compact('user', 'balance', 'modules'));
    }

    public function processActivateMember(Request $request, \App\Services\CommissionService $commissionService)
    {
        $request->validate([
            'sponsor_id' => 'required|string',
            'module_id' => 'required|exists:course_modules,id',
            'mpin' => 'required|digits:4'
        ]);

        // Find the user by their referral code (Activation ID)
        $targetUser = \App\Models\User::where('referral_code', strtoupper(trim($request->sponsor_id)))->first();

        if (!$targetUser) {
            return back()->with('error', 'Invalid User ID. User not found.');
        }

        if ($targetUser->status === 'active') {
            return back()->with('error', 'This user is already active.');
        }

        $currentUser = Auth::user();
        
        // --- MPIN Verification ---
        if (empty($currentUser->mpin)) {
            return back()->with('error', 'Security MPIN not set. Please set your MPIN in profile settings first.');
        }

        if (!\Illuminate\Support\Facades\Hash::check(trim($request->mpin), $currentUser->mpin)) {
            return back()->with('error', 'Invalid Security MPIN. Please try again.');
        }

        $wallet = $currentUser->wallet;
        $price = 300.00;

        if (!$wallet || $wallet->package_wallet < $price) {
            return back()->with('error', 'Insufficient funds in your Package Wallet. You need $300.');
        }

        // Deduct from current user
        $wallet->decrement('package_wallet', $price);

        // Get the selected module
        $module = \App\Models\CourseModule::with('courses')->findOrFail($request->module_id);

        // Grant access to all courses inside this module for TARGET user
        foreach ($module->courses as $course) {
            if ($course->status == 'active') {
                \App\Models\CourseProgress::firstOrCreate([
                    'user_id' => $targetUser->id,
                    'course_id' => $course->id,
                ]);
            }
        }

        // Activate TARGET User
        $targetUser->status = 'active';
        $targetUser->activation_date = now();
        $targetUser->save();

        // Distribute upline commissions
        $commissionService->distributeCommissions($targetUser, $price);

        // Check for Reward Income milestones
        app(\App\Services\BonusService::class)->checkAndDistributeRewardIncome($targetUser);

        // Give 300 free NEXA 1.0 upon activation
        $tokenValue = (float) \App\Models\Setting::get('utility_token_value', 0.10);
        \App\Models\TokenLedger::create([
            'user_id' => $targetUser->id,
            'token_type' => 'utility',
            'token_count' => 300,
            'token_value' => $tokenValue,
            'source' => 'activation_bonus',
            'status' => 'credited',
            'credited_date' => now(),
        ]);
        $targetWallet = \App\Models\Wallet::firstOrCreate(['user_id' => $targetUser->id]);
        $targetWallet->increment('utility_token_wallet', 300);

        \App\Models\ActivityLog::log('account_activated_by_sponsor', 'Activated account '.$targetUser->username.' with NGO Package for $' . $price, $currentUser->id);
        \App\Models\ActivityLog::log('account_activated', 'Account activated by sponsor '.$currentUser->username.' for $' . $price, $targetUser->id);

        return back()->with('success', "Account for {$targetUser->name} activated successfully!");
    }

    public function lookupMember(Request $request)
    {
        $sponsorId = strtoupper(trim($request->input('sponsor_id')));
        
        if (empty($sponsorId)) {
            return response()->json([
                'success' => false,
                'message' => 'Please enter a Sponsor Activation ID.'
            ]);
        }

        $user = \App\Models\User::where('referral_code', $sponsorId)->first();

        if ($user) {
            return response()->json([
                'success' => true,
                'user' => [
                    'referral_code' => $user->referral_code,
                    'name' => $user->name,
                    'email' => $user->email,
                    'status' => $user->status
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Member not found.'
        ]);
    }
}