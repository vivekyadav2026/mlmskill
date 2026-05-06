<?php

$controllersDir = __DIR__ . '/app/Http/Controllers/';
$viewsDir = __DIR__ . '/resources/views/admin/';

// Admin Users Controller
$adminUserCtrl = <<<PHP
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index() {
        \$users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }
    public function active() {
        \$users = User::where('status', 'active')->latest()->paginate(15);
        return view('admin.users.active', compact('users'));
    }
    public function inactive() {
        \$users = User::where('status', 'inactive')->latest()->paginate(15);
        return view('admin.users.inactive', compact('users'));
    }
}
PHP;
file_put_contents($controllersDir . 'AdminUserController.php', $adminUserCtrl);

// Admin Withdrawal Controller
$adminWithdrawCtrl = <<<PHP
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Withdrawal;
use App\Models\User;

class AdminWithdrawalController extends Controller
{
    public function pending() {
        \$withdrawals = Withdrawal::with('user')->where('status', 'pending')->latest()->paginate(15);
        return view('admin.withdrawals.pending', compact('withdrawals'));
    }
    public function approved() {
        \$withdrawals = Withdrawal::with('user')->where('status', 'approved')->latest()->paginate(15);
        return view('admin.withdrawals.approved', compact('withdrawals'));
    }
    public function rejected() {
        \$withdrawals = Withdrawal::with('user')->where('status', 'rejected')->latest()->paginate(15);
        return view('admin.withdrawals.rejected', compact('withdrawals'));
    }
    public function approve(\$id) {
        \$withdrawal = Withdrawal::findOrFail(\$id);
        \$withdrawal->status = 'approved';
        \$withdrawal->save();
        return redirect()->back()->with('success', 'Withdrawal approved.');
    }
    public function reject(\$id) {
        \$withdrawal = Withdrawal::findOrFail(\$id);
        \$withdrawal->status = 'rejected';
        \$withdrawal->save();
        return redirect()->back()->with('success', 'Withdrawal rejected.');
    }
}
PHP;
file_put_contents($controllersDir . 'AdminWithdrawalController.php', $adminWithdrawCtrl);

// Admin Activation Controller
$adminActivationCtrl = <<<PHP
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class AdminActivationController extends Controller
{
    public function manual() {
        \$users = User::where('status', 'inactive')->get();
        return view('admin.activations.manual', compact('users'));
    }
    public function activate(Request \$request) {
        \$request->validate(['user_id' => 'required|exists:users,id']);
        \$user = User::findOrFail(\$request->user_id);
        \$user->status = 'active';
        \$user->activation_date = now();
        \$user->save();
        return redirect()->back()->with('success', 'User ' . \$user->email . ' activated successfully!');
    }
}
PHP;
file_put_contents($controllersDir . 'AdminActivationController.php', $adminActivationCtrl);

// Views
$views = [
    'users/index' => 'All Users',
    'users/active' => 'Active Users',
    'users/inactive' => 'Inactive Users',
    'withdrawals/pending' => 'Pending Withdrawals',
    'withdrawals/approved' => 'Approved Withdrawals',
    'withdrawals/rejected' => 'Rejected Withdrawals',
    'activations/manual' => 'Manual User Activation',
    'activations/requests' => 'Activation Requests',
    'activations/history' => 'Payment History',
    'wallets/index' => 'All Wallets',
    'wallets/adjustments' => 'Wallet Adjustments',
    'wallets/logs' => 'Wallet Logs',
    'tokens/settings' => 'Token Settings',
    'tokens/logs' => 'Token Distribution Logs',
    'tokens/manual' => 'Manual Token Credit',
    'commissions/direct' => 'Direct Income Logs',
    'commissions/level' => 'Level Income Logs',
    'commissions/settings' => 'Commission Settings',
];

foreach ($views as $path => $title) {
    $fullPath = $viewsDir . $path . '.blade.php';
    if (!is_dir(dirname($fullPath))) {
        mkdir(dirname($fullPath), 0777, true);
    }

    if (strpos($path, 'users/') === 0) {
        $html = <<<HTML
@extends('layouts.admin')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; text-transform: capitalize; }</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">$title</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead><tr><th>Name</th><th>Email</th><th>Referral Code</th><th>Status</th><th>Joined</th></tr></thead>
            <tbody>
                @forelse(\$users as \$u)
                <tr>
                    <td class="font-bold">{{ \$u->name }}</td>
                    <td><span class="lowercase">{{ \$u->email }}</span></td>
                    <td class="text-indigo-400 font-mono">{{ \$u->referral_code }}</td>
                    <td><span class="px-2 py-1 text-xs rounded bg-{{ \$u->status=='active'?'green':'red' }}-900 text-{{ \$u->status=='active'?'green':'red' }}-300">{{ \$u->status }}</span></td>
                    <td>{{ \$u->created_at->format('M d, Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center p-8 text-gray-500">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#334155]">{{ \$users->links() ?? '' }}</div>
    </div>
</div>
@endsection
HTML;
    } elseif (strpos($path, 'withdrawals/') === 0) {
        $html = <<<HTML
@extends('layouts.admin')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">$title</h2></div>
    @if(session('success')) <div class="bg-green-500/10 text-green-400 p-4 rounded mb-4">{{ session('success') }}</div> @endif
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead><tr><th>User</th><th>Amount</th><th>Status</th><th>Requested At</th><th>Action</th></tr></thead>
            <tbody>
                @forelse(\$withdrawals as \$w)
                <tr>
                    <td class="font-bold">{{ \$w->user->name ?? 'Unknown' }}</td>
                    <td class="font-bold text-green-400">$\{{ number_format(\$w->amount, 2) }}</td>
                    <td><span class="px-2 py-1 text-xs rounded capitalize bg-{{ \$w->status=='approved'?'green':(\$w->status=='rejected'?'red':'yellow') }}-900 text-{{ \$w->status=='approved'?'green':(\$w->status=='rejected'?'red':'yellow') }}-300">{{ \$w->status }}</span></td>
                    <td>{{ \$w->created_at->format('M d, Y H:i') }}</td>
                    <td>
                        @if(\$w->status === 'pending')
                        <div class="flex gap-2">
                            <form method="POST" action="{{ url('admin/withdrawals/'.\$w->id.'/approve') }}">@csrf<button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs shadow"><i class="fa-solid fa-check"></i> Approve</button></form>
                            <form method="POST" action="{{ url('admin/withdrawals/'.\$w->id.'/reject') }}">@csrf<button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs shadow"><i class="fa-solid fa-xmark"></i> Reject</button></form>
                        </div>
                        @else
                        <span class="text-gray-500 text-xs italic">Processed</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center p-8 text-gray-500">No withdrawals found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#334155]">{{ \$withdrawals->links() ?? '' }}</div>
    </div>
</div>
@endsection
HTML;
    } elseif ($path === 'activations/manual') {
        $html = <<<HTML
@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-2xl mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">$title</h2><p class="text-gray-400">Manually activate a user account bypassing the automated payment gateway.</p></div>
    @if(session('success')) <div class="bg-green-500/10 text-green-400 p-4 rounded mb-4">{{ session('success') }}</div> @endif
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-8">
        <form action="{{ url('admin/activations/manual') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label class="block text-gray-300 mb-2">Select Inactive User</label>
                <select name="user_id" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required>
                    <option value="">-- Choose User --</option>
                    @foreach(\$users as \$u)
                        <option value="{{ \$u->id }}">{{ \$u->name }} ({{ \$u->email }})</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded shadow">Activate User Account ($300 Course)</button>
        </form>
    </div>
</div>
@endsection
HTML;
    } else {
        $html = <<<HTML
@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4"><h2 class="text-2xl font-bold text-gray-100 mb-6">$title</h2>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-10 text-center"><i class="fa-solid fa-microchip text-4xl text-indigo-500 mb-4"></i><h3 class="text-xl text-gray-200">System Admin Module</h3><p class="text-gray-500 mt-2">Core data and settings will populate here.</p></div>
</div>
@endsection
HTML;
    }
    file_put_contents($fullPath, $html);
}

echo "Admin Controllers and Views generated successfully.";
