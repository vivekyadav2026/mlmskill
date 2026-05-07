<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\File;

class AdminLogController extends Controller
{
    // ── ACTIVITY LOGS ───────────────────────────────────────
    public function activityLogs(Request $request)
    {
        $logs = ActivityLog::with('user')->latest()->paginate(50);
        return view('admin.logs.activity', compact('logs'));
    }

    // ── SYSTEM LOGS ─────────────────────────────────────────
    public function systemLogs()
    {
        $logPath = storage_path('logs/laravel.log');
        $logs = [];
        
        if (File::exists($logPath)) {
            $file = file($logPath);
            // Get last 500 lines for performance
            $lines = array_slice($file, -500);
            $logs = array_reverse($lines);
        }

        return view('admin.logs.system', compact('logs'));
    }

    // ── ERROR LOGS ──────────────────────────────────────────
    public function errorLogs()
    {
        $logPath = storage_path('logs/laravel.log');
        $errorLogs = [];
        
        if (File::exists($logPath)) {
            $file = file($logPath);
            // Filter only ERROR lines
            $errors = array_filter($file, function($line) {
                return strpos($line, 'local.ERROR:') !== false || strpos($line, 'production.ERROR:') !== false;
            });
            // Get last 200 errors
            $lines = array_slice($errors, -200);
            $errorLogs = array_reverse($lines);
        }

        return view('admin.logs.error', compact('errorLogs'));
    }
    
    // Clear Laravel Log file
    public function clearSystemLogs()
    {
        $logPath = storage_path('logs/laravel.log');
        if (File::exists($logPath)) {
            File::put($logPath, '');
            ActivityLog::log('clear_system_logs', 'Cleared system logs');
        }
        return back()->with('success', 'System logs cleared successfully.');
    }
}
