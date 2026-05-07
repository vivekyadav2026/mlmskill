<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\CommissionLedger;
use App\Models\CourseProgress;
use App\Models\Course;
use Carbon\Carbon;

class AdminAnalyticsController extends Controller
{
    public function index() { 
        // 1. Top Stat Cards
        $totalUsers = User::count();
        $activeUsers = User::where('status', 'active')->count();
        $conversionRate = $totalUsers > 0 ? round(($activeUsers / $totalUsers) * 100, 1) : 0;
        
        $totalCommission = CommissionLedger::sum('amount');
        $avgCommission = $activeUsers > 0 ? round($totalCommission / $activeUsers, 2) : 0;
        
        // 2. Trend Data (Last 7 Days)
        $trendLabels = [];
        $revenueData = [];
        $registrationData = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $trendLabels[] = $date->format('M d');
            
            $revSum = CommissionLedger::whereDate('created_at', $date)->sum('amount');
            $revenueData[] = round($revSum, 2);
            
            $regCount = User::whereDate('created_at', $date)->count();
            $registrationData[] = $regCount;
        }

        // 3. User Distribution by Package (Course)
        $courseDistribution = DB::table('course_progress')
            ->join('courses', 'course_progress.course_id', '=', 'courses.id')
            ->select('courses.title', DB::raw('count(course_progress.id) as total'))
            ->groupBy('courses.title')
            ->pluck('total', 'title')->toArray();
            
        $courseLabels = array_keys($courseDistribution);
        $courseData = array_values($courseDistribution);
        if(empty($courseData)) {
            $courseLabels = ['No Courses Sold'];
            $courseData = [1];
        }

        return view('admin.analytics', compact(
            'conversionRate', 'avgCommission', 
            'trendLabels', 'revenueData', 'registrationData', 
            'courseLabels', 'courseData'
        )); 
    }
}