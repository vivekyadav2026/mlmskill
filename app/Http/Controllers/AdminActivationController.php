<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ActivationRequest;
use App\Services\ActivationService;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;

class AdminActivationController extends Controller
{
    protected ActivationService $activationService;

    public function __construct(ActivationService $activationService)
    {
        $this->activationService = $activationService;
    }

    // ── 1. ACTIVATION REQUESTS (PENDING) ──
    public function requests() 
    {
        $requests = ActivationRequest::with('user')->where('status', 'pending')->latest()->get();
        return view('admin.activations.requests', compact('requests'));
    }

    // Approve Request
    public function approveRequest($id) 
    {
        $req = ActivationRequest::findOrFail($id);
        
        try {
            // Activate User
            $this->activationService->activateUser($req->user);
            
            // Mark as Approved
            $req->update(['status' => 'approved', 'remarks' => 'Approved by admin']);
            
            ActivityLog::log('activation_approved', 'Approved activation request for ' . $req->user->email);
            
            return redirect()->back()->with('success', 'Activation Request Approved & User Activated!');
        } catch (\Exception $e) {
            // If user is already active, just mark the request as approved so it clears from the list
            if ($e->getMessage() === 'User is already active.') {
                $req->update(['status' => 'approved', 'remarks' => 'Approved (User was already active)']);
                return redirect()->back()->with('success', 'Request cleared (User was already active).');
            }
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // Reject Request
    public function rejectRequest(Request $request, $id) 
    {
        try {
            DB::beginTransaction();
            $req = ActivationRequest::findOrFail($id);
            
            // Refund wallet if payment method was Wallet Balance
            if ($req->payment_method === 'Wallet Balance') {
                $wallet = \App\Models\Wallet::firstOrCreate(['user_id' => $req->user_id]);
                $wallet->increment('package_wallet', $req->amount);
            }
            
            $req->update([
                'status' => 'rejected', 
                'remarks' => $request->input('remarks', 'Rejected due to invalid payment.')
            ]);
            
            ActivityLog::log('activation_rejected', 'Rejected activation request for ' . $req->user->email);
            
            DB::commit();
            return redirect()->back()->with('success', 'Request rejected successfully. User wallet refunded if applicable.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error processing rejection: ' . $e->getMessage());
        }
    }


    // ── 2. ACTIVATION HISTORY ──
    public function history() 
    {
        $requests = ActivationRequest::with('user')->whereIn('status', ['approved', 'rejected'])->latest()->paginate(15);
        return view('admin.activations.history', compact('requests'));
    }


    // ── 3. MANUAL ACTIVATION (BYPASS PAYMENT) ──
    public function manual() 
    {
        $users = User::where('status', 'inactive')->get();
        return view('admin.activations.manual', compact('users'));
    }

    public function activate(Request $request) 
    {
        $request->validate(['user_id' => 'required|exists:users,id']);
        $user = User::findOrFail($request->user_id);
        
        try {
            $this->activationService->activateUser($user);
            ActivityLog::log('manual_activation', 'Manually activated user ' . $user->email);
            return redirect()->back()->with('success', 'User ' . $user->email . ' activated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}