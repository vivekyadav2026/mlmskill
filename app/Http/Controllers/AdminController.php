<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Withdrawal;
use App\Models\CommissionLedger;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Users stats
        $totalUsers = User::count();
        $activeUsers = User::where('status', 'active')->count();
        $inactiveUsers = $totalUsers - $activeUsers;

        // Income & Tokens
        $totalIncome = CommissionLedger::sum('amount');
        $directIncomePaid = CommissionLedger::where('commission_type', 'direct')->sum('amount');
        $levelIncomePaid = CommissionLedger::where('commission_type', 'level')->sum('amount');
        $totalUtilityTokens = \App\Models\TokenLedger::where('token_type', 'utility')->sum('token_count');
        $totalRenewalTokens = \App\Models\TokenLedger::where('token_type', 'renewal')->sum('token_count');

        // Withdrawals
        $pendingWithdrawalsAmount = Withdrawal::where('status', 'pending')->sum('amount');
        $pendingWithdrawalsCount = Withdrawal::where('status', 'pending')->count();
        $totalWithdrawalsPaid = Withdrawal::where('status', 'approved')->sum('amount');
        
        // Lists
        $latestRegistrations = User::latest()->take(5)->get();
        $latestActivations = User::where('status', 'active')->whereNotNull('activation_date')->orderBy('activation_date', 'desc')->take(5)->get();
        $latestWithdrawals = Withdrawal::with('user')->latest()->take(5)->get();
            
        return view('admin.dashboard', compact(
            'totalUsers', 'activeUsers', 'inactiveUsers',
            'totalIncome', 'directIncomePaid', 'levelIncomePaid',
            'totalUtilityTokens', 'totalRenewalTokens',
            'pendingWithdrawalsAmount', 'pendingWithdrawalsCount', 'totalWithdrawalsPaid',
            'latestRegistrations', 'latestActivations', 'latestWithdrawals'
        ));
    }

    public function users()
    {
        $users = User::paginate(20);
        return view('admin.users', compact('users'));
    }

    public function adminView($section, $subsection = null)
    {
        $title = ucfirst($section) . ($subsection ? ' - ' . ucfirst($subsection) : '');
        $path = $subsection ? "{$section} / {$subsection}" : $section;
        
        $viewPath = $subsection ? "admin.{$section}.{$subsection}" : "admin.{$section}";
        if (view()->exists($viewPath)) {
            return view($viewPath, compact('title', 'path'));
        }
        
        return view('admin.placeholder', compact('title', 'path'));
    }
}
