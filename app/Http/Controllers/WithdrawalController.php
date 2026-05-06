<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WalletService;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WithdrawalController extends Controller
{
    protected WalletService $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    public function requestWithdrawal(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1'
        ]);

        try {
            $this->walletService->requestWithdrawal(Auth::user(), $request->amount);
            return redirect()->back()->with('success', 'Withdrawal requested successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function approve($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        
        if ($withdrawal->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending withdrawals can be approved.');
        }

        $withdrawal->status = 'approved';
        $withdrawal->approved_by = Auth::id();
        $withdrawal->save();

        return redirect()->back()->with('success', 'Withdrawal approved.');
    }

    public function reject($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        
        if ($withdrawal->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending withdrawals can be rejected.');
        }

        DB::transaction(function () use ($withdrawal) {
            $withdrawal->status = 'rejected';
            $withdrawal->approved_by = Auth::id();
            $withdrawal->save();

            // Refund
            $wallet = $withdrawal->user->wallet;
            if ($wallet) {
                $wallet->increment('income_wallet', $withdrawal->amount);
            }
        });

        return redirect()->back()->with('success', 'Withdrawal rejected and refunded.');
    }
}
