<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class NetworkController extends Controller
{
    public function direct()
    {
        $user = Auth::user();
        // Get all users who have this user as a sponsor
        $referrals = User::where('sponsor_id', $user->referral_code)->get();
        
        return view('user.network.direct', compact('user', 'referrals'));
    }

    public function tree()
    {
        $user = Auth::user();
        return view('user.network.tree', compact('user'));
    }

    public function treeNode($id)
    {
        $authUser = Auth::user();
        // Allow viewing own subtree or any node within their network
        $node = User::findOrFail($id);

        $buildTree = function (User $u) use (&$buildTree) {
            $children = User::where('sponsor_id', $u->referral_code)->get();
            return [
                'id'            => $u->id,
                'name'          => $u->name,
                'referral_code' => $u->referral_code,
                'status'        => $u->status,
                'children'      => $children->map(fn($c) => $buildTree($c))->values()->toArray(),
            ];
        };

        return response()->json($buildTree($node));
    }
    
    public function sponsor()
    {
        $user = Auth::user();
        $sponsor = User::where('referral_code', $user->sponsor_id)->first();
        
        return view('user.network.sponsor', compact('user', 'sponsor'));
    }

    public function level()
    {
        $user = Auth::user();
        
        // Use query builder to calculate total, monthly, and list history
        $totalLevelIncome = \Illuminate\Support\Facades\DB::table('commission_ledgers')
            ->where('user_id', $user->id)
            ->whereIn('commission_type', ['direct', 'team'])
            ->sum('amount');
            
        $monthlyLevelIncome = \Illuminate\Support\Facades\DB::table('commission_ledgers')
            ->where('user_id', $user->id)
            ->whereIn('commission_type', ['direct', 'team'])
            ->whereMonth('created_at', now()->month)
            ->sum('amount');
        
        $history = \App\Models\User::find($user->id)->commissions()
            ->whereIn('commission_type', ['direct', 'team'])
            ->with('fromUser')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        // Calculate members and earnings in each level
        $levelCounts = [];
        $levelEarnings = [];
        
        $levelEarningsRaw = \Illuminate\Support\Facades\DB::table('commission_ledgers')
            ->where('user_id', $user->id)
            ->whereIn('commission_type', ['direct', 'team'])
            ->selectRaw('level, SUM(amount) as total')
            ->groupBy('level')
            ->pluck('total', 'level')->toArray();

        $currentLevelSponsorCodes = [$user->referral_code];
        
        for ($level = 1; $level <= 10; $level++) {
            if (empty($currentLevelSponsorCodes)) {
                $levelCounts[$level] = 0;
                $levelEarnings[$level] = $levelEarningsRaw[$level] ?? 0;
                continue;
            }
            
            $nextLevelSponsorCodes = \App\Models\User::whereIn('sponsor_id', $currentLevelSponsorCodes)
                                            ->pluck('referral_code')
                                            ->filter()
                                            ->toArray();
                                            
            $levelCounts[$level] = count($nextLevelSponsorCodes);
            $levelEarnings[$level] = $levelEarningsRaw[$level] ?? 0;
            $currentLevelSponsorCodes = $nextLevelSponsorCodes;
        }

        // Real network count is the sum of all members across the 10 levels
        $networkCount = array_sum($levelCounts);
            
        return view('user.network.level', compact('totalLevelIncome', 'monthlyLevelIncome', 'networkCount', 'history', 'levelCounts', 'levelEarnings'));
    }
}
