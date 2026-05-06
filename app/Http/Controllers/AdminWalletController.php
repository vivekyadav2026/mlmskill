<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\User;

class AdminWalletController extends Controller
{
    public function index() {
        $wallets = Wallet::with('user')->paginate(15);
        return view('admin.wallets.index', compact('wallets'));
    }
    public function adjustments() {
        $users = User::all();
        return view('admin.wallets.adjustments', compact('users'));
    }
    public function adjust(Request $request) {
        $request->validate(['user_id'=>'required', 'wallet_type'=>'required', 'amount'=>'required|numeric']);
        $wallet = Wallet::firstOrCreate(['user_id' => $request->user_id]);
        $type = $request->wallet_type;
        $wallet->$type += $request->amount;
        $wallet->save();
        return redirect()->back()->with('success', 'Wallet adjusted successfully.');
    }
    public function logs() {
        return view('admin.wallets.logs');
    }
}