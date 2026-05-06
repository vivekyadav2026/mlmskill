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
        $request->validate([
            'amount' => 'required|numeric|min:10'
        ]);
        // Demo mode logic
        return redirect()->back()->with('success', 'Withdrawal request submitted successfully! Pending admin approval.');
    }

    public function history()
    {
        $user = Auth::user();
        $withdrawals = Withdrawal::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(15);
        return view('user.withdraw.history', compact('withdrawals'));
    }
}