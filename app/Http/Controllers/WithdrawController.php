<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Withdrawal;

class WithdrawController extends Controller
{
    public function request()
    {
        $user = Auth::user();
        $balance = $user->wallet->income_wallet ?? 0;
        return view('user.withdraw.request', compact('user', 'balance'));
    }

    public function submit(Request $request)
    {
        $min = (float) \App\Models\Setting::get('min_withdrawal', 10.00);
        $max = (float) \App\Models\Setting::get('max_withdrawal', 5000.00);

        $request->validate([
            'amount' => "required|numeric|min:{$min}|max:{$max}",
            'mpin' => 'required|digits:4',
        ]);

        $user = Auth::user();

        // Verify MPIN
        if (!\Illuminate\Support\Facades\Hash::check($request->mpin, $user->mpin)) {
            return back()->with('error', 'Invalid MPIN. Withdrawal cancelled.');
        }

        $wallet = $user->wallet;
        $amount = (float) $request->amount;

        if (!$wallet || $wallet->income_wallet < $amount) {
            return back()->with('error', 'Insufficient funds in your Income Wallet.');
        }

        \Illuminate\Support\Facades\DB::transaction(function () use ($user, $wallet, $amount) {
            // Deduct from wallet
            $wallet->decrement('income_wallet', $amount);

            // Create withdrawal record
            Withdrawal::create([
                'user_id' => $user->id,
                'amount' => $amount,
                'status' => 'pending',
                // other details can be added later (like method/address)
            ]);
            
            \App\Models\ActivityLog::log('withdrawal_request', 'Requested withdrawal of $' . $amount, $user->id);
        });

        return redirect()->back()->with('success', 'Withdrawal request submitted successfully! Pending admin approval.');
    }

    public function history()
    {
        $user = Auth::user();
        $withdrawals = Withdrawal::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(15);
        return view('user.withdraw.history', compact('withdrawals'));
    }
}