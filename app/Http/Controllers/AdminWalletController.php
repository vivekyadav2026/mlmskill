<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wallet;
use App\Models\User;
use App\Models\WalletAdjustmentLog;

class AdminWalletController extends Controller
{
    public function index()
    {
        $wallets = Wallet::with('user')->paginate(15);
        return view('admin.wallets.index', compact('wallets'));
    }

    public function adjustments()
    {
        $users = User::orderBy('name')->get();
        return view('admin.wallets.adjustments', compact('users'));
    }

    public function adjust(Request $request)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'wallet_type' => 'required|in:income_wallet,package_wallet,utility_token_wallet,renewal_token_wallet,nexa_3_wallet',
            'amount'      => 'required|numeric',
            'note'        => 'nullable|string|max:255',
        ]);

        $wallet = Wallet::firstOrCreate(['user_id' => $request->user_id]);
        $type   = $request->wallet_type;

        $balanceBefore = $wallet->$type ?? 0;
        $wallet->$type = $balanceBefore + $request->amount;
        $wallet->save();
        $balanceAfter = $wallet->$type;

        // Write audit log
        WalletAdjustmentLog::create([
            'admin_id'       => Auth::id(),
            'user_id'        => $request->user_id,
            'wallet_type'    => $type,
            'amount'         => $request->amount,
            'balance_before' => $balanceBefore,
            'balance_after'  => $balanceAfter,
            'note'           => $request->note,
        ]);

        return redirect()->back()->with('success', 'Wallet adjusted successfully. Log recorded.');
    }

    public function logs()
    {
        $logs = WalletAdjustmentLog::with(['admin', 'user'])
            ->latest()
            ->paginate(20);

        return view('admin.wallets.logs', compact('logs'));
    }
}