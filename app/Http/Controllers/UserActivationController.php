<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\ActivationRequest;
use Illuminate\Support\Facades\Auth;

class UserActivationController extends Controller
{
    public function inactive()
    {
        $settings = Setting::pluck('value', 'key');
        $fee = $settings['registration_fee'] ?? 0;
        
        // Check if there is an existing pending request
        $pendingRequest = ActivationRequest::where('user_id', Auth::id())
                            ->where('status', 'pending')
                            ->first();
                            
        $wallet = \App\Models\Wallet::firstOrCreate(['user_id' => Auth::id()]);
        $walletBalance = $wallet->package_wallet;

        return view('user.inactive', compact('settings', 'fee', 'pendingRequest', 'walletBalance'));
    }

    public function submit(Request $request)
    {
        // $request->validate([
        //     'payment_method' => 'required|string|max:100',
        //     'transaction_id' => 'required|string|max:100',
        //     'screenshot'     => 'required|image|max:2048', // 2MB Max
        // ]);

        $settings = Setting::pluck('value', 'key');
        $fee = $settings['registration_fee'] ?? 0;

        // $path = $request->file('screenshot')->store('activation_proofs', 'public');

        ActivationRequest::create([
            'user_id' => Auth::id(),
            'amount' => $fee,
            'payment_method' => 'Direct Request',
            'transaction_id' => 'REQ-' . strtoupper(uniqid()),
            'screenshot' => null, // No proof required
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Payment proof submitted! Please wait for admin approval.');
    }
}
