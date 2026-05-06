<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Withdrawal;
use App\Models\User;

class AdminWithdrawalController extends Controller
{
    public function pending() {
        $withdrawals = Withdrawal::with('user')->where('status', 'pending')->latest()->paginate(15);
        return view('admin.withdrawals.pending', compact('withdrawals'));
    }
    public function approved() {
        $withdrawals = Withdrawal::with('user')->where('status', 'approved')->latest()->paginate(15);
        return view('admin.withdrawals.approved', compact('withdrawals'));
    }
    public function rejected() {
        $withdrawals = Withdrawal::with('user')->where('status', 'rejected')->latest()->paginate(15);
        return view('admin.withdrawals.rejected', compact('withdrawals'));
    }
    public function approve($id) {
        $withdrawal = Withdrawal::findOrFail($id);
        $withdrawal->status = 'approved';
        $withdrawal->save();
        return redirect()->back()->with('success', 'Withdrawal approved.');
    }
    public function reject($id) {
        $withdrawal = Withdrawal::findOrFail($id);
        $withdrawal->status = 'rejected';
        $withdrawal->save();
        return redirect()->back()->with('success', 'Withdrawal rejected.');
    }
}