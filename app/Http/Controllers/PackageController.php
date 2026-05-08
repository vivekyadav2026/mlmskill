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

    public function history()
    {
        $user = Auth::user();
        // Assuming a package_purchases table or just use user activation dates for now
        return view('user.package.history', compact('user'));
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

        \App\Models\ActivityLog::log('account_activated', 'Activated account with NGO Package for $' . $price, $user->id);

        return redirect()->route('dashboard')->with('success', 'Account activated successfully! You now have full access to the platform and courses.');
    }
}