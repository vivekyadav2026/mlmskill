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
        
        return view('user.wallets.package', compact('balance'));
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
            
        return view('user.wallets.utility', compact('balance', 'history'));
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
            
        return view('user.wallets.renewal', compact('balance', 'history'));
    }

    public function history()
    {
        $user = Auth::user();
        return view('user.wallets.history', compact('user'));
    }

    public function transfer()
    {
        $user = Auth::user();
        $balance = $user->wallet->income_wallet ?? 0;
        return view('user.wallets.transfer', compact('balance'));
    }

    public function processTransfer(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|string|exists:users,referral_code',
            'amount' => 'required|numeric|min:1',
            'mpin' => 'required|digits:4',
        ]);

        $sender = Auth::user();
        
        // Verify MPIN
        if (!\Illuminate\Support\Facades\Hash::check($request->mpin, $sender->mpin)) {
            return back()->with('error', 'Invalid MPIN. Transfer cancelled.');
        }

        if ($sender->referral_code === $request->recipient_id) {
            return back()->with('error', 'You cannot transfer to yourself using this form. Use Wallet Conversion instead.');
        }

        $recipient = \App\Models\User::where('referral_code', $request->recipient_id)->first();
        $amount = (float) $request->amount;
        $senderWallet = $sender->wallet;

        if (!$senderWallet || $senderWallet->income_wallet < $amount) {
            return back()->with('error', 'Insufficient funds in your Income Wallet.');
        }

        DB::transaction(function () use ($sender, $senderWallet, $recipient, $amount) {
            // Deduct from sender's income wallet
            $senderWallet->decrement('income_wallet', $amount);

            // Add to recipient's package wallet
            $recipientWallet = \App\Models\Wallet::firstOrCreate(['user_id' => $recipient->id]);
            $recipientWallet->increment('package_wallet', $amount);

            // Log the transfer
            \App\Models\ActivityLog::log('p2p_transfer', 'Transferred $' . $amount . ' to ' . $recipient->name . ' (' . $recipient->referral_code . ')', $sender->id);
            \App\Models\ActivityLog::log('p2p_received', 'Received $' . $amount . ' from ' . $sender->name . ' (' . $sender->referral_code . ')', $recipient->id);
        });

        return redirect()->route('dashboard')->with('success', '$' . number_format($amount, 2) . ' successfully transferred to ' . $recipient->name . '. They can now activate their account.');
    }

    public function p2pHistory()
    {
        $user = Auth::user();
        $history = \App\Models\ActivityLog::where('user_id', $user->id)
                    ->whereIn('action', ['p2p_transfer', 'p2p_received'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);
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
