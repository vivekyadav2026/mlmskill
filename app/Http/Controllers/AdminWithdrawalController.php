<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Withdrawal;
use App\Models\Wallet;
use App\Models\User;

class AdminWithdrawalController extends Controller
{
    public function pending()
    {
        $withdrawals = Withdrawal::with('user')->where('status', 'pending')->latest()->paginate(15);
        return view('admin.withdrawals.pending', compact('withdrawals'));
    }

    public function approved()
    {
        $withdrawals = Withdrawal::with('user')->where('status', 'approved')->latest()->paginate(15);
        return view('admin.withdrawals.approved', compact('withdrawals'));
    }

    public function rejected()
    {
        $withdrawals = Withdrawal::with('user')->where('status', 'rejected')->latest()->paginate(15);
        return view('admin.withdrawals.rejected', compact('withdrawals'));
    }

    public function approve($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        if ($withdrawal->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending withdrawals can be approved.');
        }

        $withdrawal->status      = 'approved';
        $withdrawal->approved_by = Auth::id();
        $withdrawal->remarks     = 'Approved by admin on ' . now()->format('d M Y h:i A');
        $withdrawal->save();

        return redirect()->back()->with('success', 'Withdrawal approved successfully.');
    }

    public function reject($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        if ($withdrawal->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending withdrawals can be rejected.');
        }

        DB::transaction(function () use ($withdrawal) {
            // ✅ CRITICAL FIX: Refund the amount back to user's income wallet
            $wallet = Wallet::where('user_id', $withdrawal->user_id)->first();
            if ($wallet) {
                $wallet->increment('income_wallet', $withdrawal->amount);
            }

            // Mark as rejected and record who did it
            $withdrawal->status      = 'rejected';
            $withdrawal->approved_by = Auth::id();
            $withdrawal->remarks     = 'Rejected by admin on ' . now()->format('d M Y h:i A') . '. Amount refunded to Income Wallet.';
            $withdrawal->save();
        });

        return redirect()->back()
            ->with('success', 'Withdrawal rejected. ₹' . number_format($withdrawal->amount, 2) . ' has been refunded to the user\'s Income Wallet.');
    }

    public function logs()
    {
        $withdrawals = Withdrawal::with(['user', 'approver'])
            ->whereIn('status', ['approved', 'rejected'])
            ->latest()
            ->paginate(15);
        return view('admin.withdrawals.logs', compact('withdrawals'));
    }
}