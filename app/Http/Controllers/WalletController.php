<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function income()
    {
        $user = Auth::user();
        $balance = $user->wallet->income_wallet ?? 0;
        
        // Fetch commission history for this wallet
        $history = DB::table('commission_ledgers')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('user.wallets.income', compact('balance', 'history'));
    }

    public function package()
    {
        $user = Auth::user();
        $balance = $user->wallet->package_wallet ?? 0;
        
        $p2p = \App\Models\ActivityLog::where('user_id', $user->id)
            ->where('action', 'p2p_received')
            ->get()->map(function($item) {
                return [
                    'date' => $item->created_at,
                    'type' => 'P2P Received',
                    'desc' => $item->description,
                    'amount' => 'Credit'
                ];
            });
            
        $conversions = \App\Models\TokenLedger::where('user_id', $user->id)
            ->where('source', 'conversion')
            ->where('status', 'used')
            ->get()->map(function($item) {
                return [
                    'date' => $item->created_at,
                    'type' => 'Token Conversion',
                    'desc' => 'Converted ' . abs($item->token_count) . ' ' . ucfirst($item->token_type) . ' tokens',
                    'amount' => 'Credit'
                ];
            });
            
        $historyList = collect()->concat($p2p)->concat($conversions)->sortByDesc('date')->values();
        
        $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage();
        $perPage = 15;
        $currentItems = $historyList->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $history = new \Illuminate\Pagination\LengthAwarePaginator($currentItems, count($historyList), $perPage, $currentPage, [
            'path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()
        ]);
        
        return view('user.wallets.package', compact('balance', 'history'));
    }

    public function utility()
    {
        $user = Auth::user();
        $balance = $user->wallet->utility_token_wallet ?? 0;
        
        $history = DB::table('token_ledgers')
            ->where('user_id', $user->id)
            ->where('token_type', 'utility')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        $chartData = DB::table('token_ledgers')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(token_count) as total'))
            ->where('user_id', $user->id)
            ->where('token_type', 'utility')
            ->where('token_count', '>', 0)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy(DB::raw('DATE(created_at)'), 'asc')
            ->take(30)
            ->get();
            
        $tokenName = \App\Models\Setting::get('utility_token_name', 'SKT');
            
        return view('user.wallets.utility', compact('balance', 'history', 'chartData', 'tokenName'));
    }

    public function renewal()
    {
        $user = Auth::user();
        $balance = $user->wallet->renewal_token_wallet ?? 0;
        
        $history = DB::table('token_ledgers')
            ->where('user_id', $user->id)
            ->where('token_type', 'renewal')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        $renewalTarget = \App\Models\Setting::get('renewal_limit', 300);
            
        return view('user.wallets.renewal', compact('balance', 'history', 'renewalTarget'));
    }

    public function history(Request $request)
    {
        $user = Auth::user();
        $tokenName = \App\Models\Setting::get('utility_token_name', 'SKT');
        $renewalTarget = \App\Models\Setting::get('renewal_limit', 300);
        
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        
        // Helper function to apply date filters
        $applyDateFilter = function($query) use ($fromDate, $toDate) {
            if ($fromDate) {
                $query->whereDate('created_at', '>=', $fromDate);
            }
            if ($toDate) {
                $query->whereDate('created_at', '<=', $toDate);
            }
            return $query;
        };
        
        // Create consolidated history
        $commissions = $applyDateFilter(DB::table('commission_ledgers')->where('user_id', $user->id))
            ->get()->map(function($item) {
                return [
                    'date' => $item->created_at,
                    'wallet' => 'Income Wallet',
                    'type' => ucfirst($item->commission_type) . ' Commission',
                    'amount' => '+$' . number_format($item->amount, 2),
                    'color' => 'text-green-400',
                    'bg' => 'bg-green-100 text-green-800'
                ];
            });
            
        $tokens = $applyDateFilter(DB::table('token_ledgers')->where('user_id', $user->id))
            ->get()->map(function($item) use ($tokenName) {
                $isAdd = $item->token_count > 0;
                $label = $item->token_type == 'utility' ? strtoupper($tokenName) : 'RT';
                return [
                    'date' => $item->created_at,
                    'wallet' => ucfirst($item->token_type) . ' Tokens',
                    'type' => 'Token ' . ucfirst($item->source ?? 'Distribution'),
                    'amount' => ($isAdd ? '+' : '') . number_format($item->token_count, 2) . ' ' . $label,
                    'color' => $isAdd ? 'text-blue-400' : 'text-red-400',
                    'bg' => $isAdd ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800'
                ];
            });
            
        $withdrawals = $applyDateFilter(DB::table('withdrawals')->where('user_id', $user->id))
            ->get()->map(function($item) {
                return [
                    'date' => $item->created_at,
                    'wallet' => 'Income Wallet',
                    'type' => 'Withdrawal ' . ucfirst($item->status),
                    'amount' => '-$' . number_format($item->amount, 2),
                    'color' => 'text-orange-400',
                    'bg' => 'bg-orange-100 text-orange-800'
                ];
            });
            
        $p2p = $applyDateFilter(\App\Models\ActivityLog::where('user_id', $user->id)
            ->whereIn('action', ['p2p_received', 'p2p_transfer']))
            ->get()->map(function($item) {
                $isReceived = $item->action == 'p2p_received';
                
                // Parse amount from description if possible
                $amountDisplay = 'View Details';
                if (preg_match('/\$([\d\.]+)/', $item->description, $m)) {
                    $amountDisplay = ($isReceived ? '+' : '-') . '$' . $m[1];
                }
                
                return [
                    'date' => $item->created_at,
                    'wallet' => $isReceived ? 'Package Wallet' : 'Income Wallet',
                    'type' => 'P2P ' . ($isReceived ? 'Received' : 'Transfer'),
                    'amount' => $amountDisplay,
                    'color' => $isReceived ? 'text-green-400' : 'text-red-400',
                    'bg' => 'bg-purple-100 text-purple-800'
                ];
            });
            
        $historyList = collect()->concat($commissions)->concat($tokens)->concat($withdrawals)->concat($p2p)
            ->sortByDesc('date')->values();
            
        if ($request->has('export') && $request->export == 'csv') {
            $headers = [
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=wallet_history.csv",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            ];
            
            $callback = function() use ($historyList) {
                $file = fopen('php://output', 'w');
                fputcsv($file, ['Date', 'Wallet', 'Transaction Type', 'Amount']);
                
                foreach ($historyList as $row) {
                    fputcsv($file, [
                        \Carbon\Carbon::parse($row['date'])->format('Y-m-d H:i:s'),
                        $row['wallet'],
                        $row['type'],
                        strip_tags($row['amount'])
                    ]);
                }
                fclose($file);
            };
            
            return response()->stream($callback, 200, $headers);
        }
            
        $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage();
        $perPage = 15;
        $currentItems = $historyList->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginatedHistory = new \Illuminate\Pagination\LengthAwarePaginator($currentItems, count($historyList), $perPage, $currentPage, [
            'path' => \Illuminate\Pagination\Paginator::resolveCurrentPath(),
            'query' => $request->query()
        ]);

        return view('user.wallets.history', compact('user', 'tokenName', 'renewalTarget', 'paginatedHistory'));
    }

    public function transfer()
    {
        $user = Auth::user();
        $balance = $user->wallet->income_wallet ?? 0;
        $packageBalance = $user->wallet->package_wallet ?? 0;
        return view('user.wallets.transfer', compact('balance', 'packageBalance'));
    }

    public function processTransfer(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|string|exists:users,referral_code',
            'amount' => 'required|numeric|min:1',
            'mpin' => 'required|digits:4',
            'source_wallet' => 'required|in:income_wallet,package_wallet',
            'destination_wallet' => 'required|in:income_wallet,package_wallet',
        ]);
        $sender = Auth::user();
        
        // Verify MPIN
        if (!\Illuminate\Support\Facades\Hash::check($request->mpin, $sender->mpin)) {
            return back()->with('error', 'Invalid MPIN. Transfer cancelled.');
        }

        $recipient = \App\Models\User::where('referral_code', $request->recipient_id)->first();
        if (!$recipient) {
            return back()->with('error', 'Recipient not found.');
        }

        if ($recipient->status !== 'active') {
            return back()->with('error', 'Transfer failed: The recipient account is not active.');
        }

        $amount = (float) $request->amount;
        $sourceWalletCol = $request->source_wallet;
        $destWalletCol = $request->destination_wallet;
        $walletLabel = ($sourceWalletCol === 'income_wallet') ? 'Income Wallet' : 'Package Wallet';
        $destLabel = ($destWalletCol === 'income_wallet') ? 'Income Wallet' : 'Package Wallet';
        $senderWallet = $sender->wallet;

        if (!$senderWallet || $senderWallet->$sourceWalletCol < $amount) {
            return back()->with('error', "Insufficient funds in your {$walletLabel}.");
        }

        $isSelfTransfer = ($sender->id === $recipient->id);

        if ($isSelfTransfer && $sourceWalletCol === $destWalletCol) {
            return back()->with('error', "Cannot transfer from {$walletLabel} to your own {$destLabel}. Select different source and destination wallets.");
        }

        DB::transaction(function () use ($sender, $senderWallet, $recipient, $amount, $isSelfTransfer, $sourceWalletCol, $destWalletCol, $walletLabel, $destLabel) {
            $senderWallet->decrement($sourceWalletCol, $amount);
            $recipientWallet = \App\Models\Wallet::firstOrCreate(['user_id' => $recipient->id]);
            $recipientWallet->increment($destWalletCol, $amount);
            if ($isSelfTransfer) {
                \App\Models\ActivityLog::log('wallet_conversion', "Converted \${$amount} from {$walletLabel} to {$destLabel}", $sender->id);
            } else {
                \App\Models\ActivityLog::log('p2p_transfer', "Transferred \${$amount} ({$walletLabel}) to {$recipient->name}'s {$destLabel} ({$recipient->referral_code})", $sender->id);
                \App\Models\ActivityLog::log('p2p_received', "Received \${$amount} into your {$destLabel} from {$sender->name} ({$sender->referral_code})", $recipient->id);
            }
        });

        if ($isSelfTransfer) {
            return redirect()->route('dashboard')->with('success', '$' . number_format($amount, 2) . " successfully converted from your {$walletLabel} to your {$destLabel}.");
        }

        return redirect()->route('dashboard')->with('success', '$' . number_format($amount, 2) . " successfully transferred from your {$walletLabel} to {$recipient->name}'s {$destLabel}.");
    }

    public function p2pHistory()
    {
        $user = Auth::user();
        $paginator = \App\Models\ActivityLog::where('user_id', $user->id)
                    ->whereIn('action', ['p2p_transfer', 'p2p_received'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);
                    
        $history = $paginator->through(function($log) {
            $parsed = [
                'type' => $log->action,
                'date' => $log->created_at,
                'amount' => '0.00',
                'target_name' => 'Unknown',
                'target_id' => 'Unknown',
                'raw' => $log->description,
            ];
            
            if ($log->action === 'p2p_transfer') {
                if (preg_match('/Transferred\s+\\$([\d\.]+).*to\s+([^\']+)\'s.*\\(([^)]+)\\)/', $log->description, $m)) {
                    $parsed['amount'] = $m[1];
                    $parsed['target_name'] = trim($m[2]);
                    $parsed['target_id'] = trim($m[3]);
                }
            } 
            else if ($log->action === 'p2p_received') {
                if (preg_match('/Received\s+\\$([\d\.]+).*from\s+(.*?)\s+\\(([^)]+)\\)/', $log->description, $m)) {
                    $parsed['amount'] = $m[1];
                    $parsed['target_name'] = trim($m[2]);
                    $parsed['target_id'] = trim($m[3]);
                }
            }
            return (object) $parsed;
        });

        return view('user.p2p.history', compact('history'));
    }

    public function mpinSettings()
    {
        $user = Auth::user();
        return view('user.p2p.mpin', compact('user'));
    }

    public function updateMpin(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_mpin' => 'required|digits:4|confirmed',
        ]);

        $user = Auth::user();

        // Verify password
        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Incorrect account password. MPIN change cancelled.');
        }

        $user->mpin = \Illuminate\Support\Facades\Hash::make($request->new_mpin);
        $user->save();

        return back()->with('success', 'Your MPIN has been successfully updated.');
    }
}
