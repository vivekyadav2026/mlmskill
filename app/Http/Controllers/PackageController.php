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
        
        // Fetch all active courses
        $courses = \App\Models\Course::where('status', 'active')->get();
        
        // Get IDs of courses the user already owns
        $purchasedCourseIds = \App\Models\CourseProgress::where('user_id', $user->id)
                                ->pluck('course_id')->toArray();
                                
        return view('user.package.upgrade', compact('user', 'balance', 'courses', 'purchasedCourseIds'));
    }

    public function history()
    {
        $user = Auth::user();
        // Assuming a package_purchases table or just use user activation dates for now
        return view('user.package.history', compact('user'));
    }

    public function purchase(Request $request, \App\Services\CommissionService $commissionService)
    {
        $request->validate(['course_id' => 'required|exists:courses,id']);
        
        $user = Auth::user();
        $wallet = $user->wallet;
        
        $course = \App\Models\Course::findOrFail($request->course_id);
        $price = (float) $course->price;

        if (!$wallet || $wallet->package_wallet < $price) {
            return back()->with('error', 'Insufficient funds in your Package Wallet.');
        }

        $alreadyPurchased = \App\Models\CourseProgress::where('user_id', $user->id)->where('course_id', $course->id)->exists();
        if ($alreadyPurchased) {
            return back()->with('error', 'You have already purchased this course.');
        }

        // Deduct from wallet
        $wallet->decrement('package_wallet', $price);

        // Grant access to course
        \App\Models\CourseProgress::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        // Distribute upline commissions
        $commissionService->distributeCommissions($user, $price);

        \App\Models\ActivityLog::log('course_purchased', 'Purchased course: ' . $course->title . ' for $' . $price, $user->id);

        return redirect()->route('dashboard')->with('success', 'Course purchased successfully! You now have full access.');
    }
}