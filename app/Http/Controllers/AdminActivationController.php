<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class AdminActivationController extends Controller
{
        public function requests() {
        // Mocking activation requests since table doesn't exist yet
        $requests = [];
        return view('admin.activations.requests', compact('requests'));
    }
    public function history() {
        $activations = User::whereNotNull('activation_date')->orderBy('activation_date', 'desc')->paginate(15);
        return view('admin.activations.history', compact('activations'));
    }
    public function manual() {
        $users = User::where('status', 'inactive')->get();
        return view('admin.activations.manual', compact('users'));
    }
    public function activate(Request $request) {
        $request->validate(['user_id' => 'required|exists:users,id']);
        $user = User::findOrFail($request->user_id);
        $user->status = 'active';
        $user->activation_date = now();
        $user->save();
        return redirect()->back()->with('success', 'User ' . $user->email . ' activated successfully!');
    }
}