<?php

$controllersDir = __DIR__ . '/app/Http/Controllers/';
$viewsDir = __DIR__ . '/resources/views/admin/';

// --- UPDATE USER CONTROLLER ---
$adminUserCtrl = file_get_contents($controllersDir . 'AdminUserController.php');
$userCtrlMethods = <<<PHP
    public function create() {
        return view('admin.users.create');
    }
    public function store(Request \$request) {
        \$request->validate(['name'=>'required', 'email'=>'required|email|unique:users', 'password'=>'required|min:6']);
        \$user = new User();
        \$user->name = \$request->name;
        \$user->email = \$request->email;
        \$user->password = \Illuminate\Support\Facades\Hash::make(\$request->password);
        \$user->role = 'user';
        \$user->status = 'inactive';
        \$user->referral_code = strtoupper(substr(md5(uniqid()), 0, 8));
        \$user->save();
        return redirect('admin/users')->with('success', 'User created successfully.');
    }
    public function tree() {
        \$users = User::with('directReferrals')->whereNull('sponsor_id')->get();
        return view('admin.users.tree', compact('users'));
    }
PHP;
$adminUserCtrl = str_replace("class AdminUserController extends Controller\n{", "class AdminUserController extends Controller\n{\n$userCtrlMethods", $adminUserCtrl);
file_put_contents($controllersDir . 'AdminUserController.php', $adminUserCtrl);

// --- UPDATE ACTIVATION CONTROLLER ---
$adminActivationCtrl = file_get_contents($controllersDir . 'AdminActivationController.php');
$actCtrlMethods = <<<PHP
    public function requests() {
        // Placeholder for real manual payment proof uploads
        return view('admin.activations.requests');
    }
    public function history() {
        \$activations = User::whereNotNull('activation_date')->orderBy('activation_date', 'desc')->paginate(15);
        return view('admin.activations.history', compact('activations'));
    }
PHP;
$adminActivationCtrl = str_replace("class AdminActivationController extends Controller\n{", "class AdminActivationController extends Controller\n{\n$actCtrlMethods", $adminActivationCtrl);
file_put_contents($controllersDir . 'AdminActivationController.php', $adminActivationCtrl);


// --- CREATE ADMIN WALLET CONTROLLER ---
$adminWalletCtrl = <<<PHP
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\User;

class AdminWalletController extends Controller
{
    public function index() {
        \$wallets = Wallet::with('user')->paginate(15);
        return view('admin.wallets.index', compact('wallets'));
    }
    public function adjustments() {
        \$users = User::all();
        return view('admin.wallets.adjustments', compact('users'));
    }
    public function adjust(Request \$request) {
        \$request->validate(['user_id'=>'required', 'wallet_type'=>'required', 'amount'=>'required|numeric']);
        \$wallet = Wallet::firstOrCreate(['user_id' => \$request->user_id]);
        \$type = \$request->wallet_type;
        \$wallet->\$type += \$request->amount;
        \$wallet->save();
        return redirect()->back()->with('success', 'Wallet adjusted successfully.');
    }
    public function logs() {
        return view('admin.wallets.logs');
    }
}
PHP;
file_put_contents($controllersDir . 'AdminWalletController.php', $adminWalletCtrl);


// --- CREATE ADMIN TOKEN CONTROLLER ---
$adminTokenCtrl = <<<PHP
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TokenLedger;

class AdminTokenController extends Controller
{
    public function settings() { return view('admin.tokens.settings'); }
    public function logs() {
        \$logs = TokenLedger::with('user')->latest()->paginate(15);
        return view('admin.tokens.logs', compact('logs'));
    }
    public function manual() { return view('admin.tokens.manual'); }
}
PHP;
file_put_contents($controllersDir . 'AdminTokenController.php', $adminTokenCtrl);

// --- CREATE ADMIN COMMISSION CONTROLLER ---
$adminCommCtrl = <<<PHP
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CommissionLedger;

class AdminCommissionController extends Controller
{
    public function direct() {
        \$logs = CommissionLedger::with('user')->where('commission_type', 'direct')->latest()->paginate(15);
        return view('admin.commissions.direct', compact('logs'));
    }
    public function level() {
        \$logs = CommissionLedger::with('user')->where('commission_type', 'level')->latest()->paginate(15);
        return view('admin.commissions.level', compact('logs'));
    }
    public function settings() { return view('admin.commissions.settings'); }
}
PHP;
file_put_contents($controllersDir . 'AdminCommissionController.php', $adminCommCtrl);

// --- CREATE ANALYTICS CONTROLLER ---
$adminAnalyticsCtrl = <<<PHP
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class AdminAnalyticsController extends Controller
{
    public function index() { return view('admin.analytics'); }
}
PHP;
file_put_contents($controllersDir . 'AdminAnalyticsController.php', $adminAnalyticsCtrl);

// --- VIEWS ---

function ensureDir($path) {
    if (!is_dir(dirname($path))) {
        mkdir(dirname($path), 0777, true);
    }
}

// Analytics View
$p = $viewsDir . 'analytics.blade.php'; ensureDir($p);
file_put_contents($p, <<<HTML
@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Deep Analytics</h2></div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-[#1a222d] border border-[#334155] p-6 rounded-lg h-64 flex items-center justify-center text-gray-500">Revenue Growth Chart</div>
        <div class="bg-[#1a222d] border border-[#334155] p-6 rounded-lg h-64 flex items-center justify-center text-gray-500">User Retention Chart</div>
    </div>
</div>
@endsection
HTML
);

// Users Create
$p = $viewsDir . 'users/create.blade.php'; ensureDir($p);
file_put_contents($p, <<<HTML
@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-2xl mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Create New User</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6">
        <form method="POST" action="{{ url('admin/users/create') }}">
            @csrf
            <div class="mb-4"><label class="block text-gray-300 mb-2">Name</label><input type="text" name="name" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required></div>
            <div class="mb-4"><label class="block text-gray-300 mb-2">Email</label><input type="email" name="email" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required></div>
            <div class="mb-6"><label class="block text-gray-300 mb-2">Password</label><input type="password" name="password" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required></div>
            <button class="bg-indigo-600 text-white px-6 py-2 rounded font-bold">Create Account</button>
        </form>
    </div>
</div>
@endsection
HTML
);

// Users Tree
$p = $viewsDir . 'users/tree.blade.php'; ensureDir($p);
file_put_contents($p, <<<HTML
@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Genealogy Tree</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6">
        <p class="text-gray-400 mb-4">Visual representation of network hierarchy.</p>
        <ul class="text-gray-300 list-disc ml-6">
            @foreach(\$users as \$u)
                <li><i class="fa-solid fa-user text-indigo-400 mr-2"></i> {{ \$u->name }} ({{ \$u->referral_code }})</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
HTML
);

// Activations History
$p = $viewsDir . 'activations/history.blade.php'; ensureDir($p);
file_put_contents($p, <<<HTML
@extends('layouts.admin')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Payment & Activation History</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead><tr><th>User</th><th>Package</th><th>Activated On</th></tr></thead>
            <tbody>
                @forelse(\$activations as \$u)
                <tr>
                    <td class="font-bold">{{ \$u->name }} <span class="text-xs text-gray-500 block">{{ \$u->email }}</span></td>
                    <td><span class="text-xs bg-indigo-900 text-indigo-300 px-2 py-1 rounded">Course $300</span></td>
                    <td>{{ \Carbon\Carbon::parse(\$u->activation_date)->format('M d, Y H:i') }}</td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center p-8 text-gray-500">No history found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#334155]">{{ \$activations->links() ?? '' }}</div>
    </div>
</div>
@endsection
HTML
);

// Wallets Index
$p = $viewsDir . 'wallets/index.blade.php'; ensureDir($p);
file_put_contents($p, <<<HTML
@extends('layouts.admin')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Master Wallets Ledger</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead><tr><th>User</th><th>Income Wallet</th><th>Package Wallet</th><th>Utility Tokens</th><th>Renewal Tokens</th></tr></thead>
            <tbody>
                @forelse(\$wallets as \$w)
                <tr>
                    <td class="font-bold">{{ \$w->user->name ?? 'Unknown' }}</td>
                    <td class="text-green-400 font-mono">$\{{ number_format(\$w->income_wallet, 2) }}</td>
                    <td class="text-purple-400 font-mono">$\{{ number_format(\$w->package_wallet, 2) }}</td>
                    <td class="text-blue-400 font-mono">{{ number_format(\$w->utility_token_wallet, 2) }} UT</td>
                    <td class="text-orange-400 font-mono">{{ number_format(\$w->renewal_token_wallet, 2) }} RT</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center p-8 text-gray-500">No wallets found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#334155]">{{ \$wallets->links() ?? '' }}</div>
    </div>
</div>
@endsection
HTML
);

// Wallets Adjustments
$p = $viewsDir . 'wallets/adjustments.blade.php'; ensureDir($p);
file_put_contents($p, <<<HTML
@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-2xl mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Wallet Adjustments</h2><p class="text-gray-400">Manually add or subtract balances from a user's wallet.</p></div>
    @if(session('success')) <div class="bg-green-500/10 text-green-400 p-4 rounded mb-4">{{ session('success') }}</div> @endif
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6">
        <form method="POST" action="{{ url('admin/wallets/adjustments') }}">
            @csrf
            <div class="mb-4"><label class="block text-gray-300 mb-2">User</label><select name="user_id" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required><option value="">-- Select User --</option>@foreach(\$users as \$u)<option value="{{ \$u->id }}">{{ \$u->name }}</option>@endforeach</select></div>
            <div class="mb-4"><label class="block text-gray-300 mb-2">Wallet Type</label><select name="wallet_type" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required><option value="income_wallet">Income Wallet</option><option value="package_wallet">Package Wallet</option><option value="utility_token_wallet">Utility Tokens</option><option value="renewal_token_wallet">Renewal Tokens</option></select></div>
            <div class="mb-6"><label class="block text-gray-300 mb-2">Amount (use negative to subtract)</label><input type="number" step="0.01" name="amount" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required></div>
            <button class="bg-orange-600 text-white px-6 py-2 rounded font-bold w-full">Execute Adjustment</button>
        </form>
    </div>
</div>
@endsection
HTML
);

// Token Logs
$p = $viewsDir . 'tokens/logs.blade.php'; ensureDir($p);
file_put_contents($p, <<<HTML
@extends('layouts.admin')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Token Distribution Logs</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead><tr><th>User</th><th>Token Type</th><th>Amount</th><th>Date</th></tr></thead>
            <tbody>
                @forelse(\$logs as \$log)
                <tr>
                    <td class="font-bold">{{ \$log->user->name ?? 'System' }}</td>
                    <td><span class="text-xs uppercase bg-gray-800 border border-gray-600 px-2 py-1 rounded">{{ \$log->token_type }}</span></td>
                    <td class="text-indigo-400 font-mono">+{{ number_format(\$log->token_count, 2) }}</td>
                    <td>{{ \$log->created_at->format('M d, Y H:i') }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center p-8 text-gray-500">No tokens minted.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#334155]">{{ \$logs->links() ?? '' }}</div>
    </div>
</div>
@endsection
HTML
);

// Settings and generic forms
$others = ['tokens/settings', 'tokens/manual', 'commissions/settings', 'activations/requests', 'wallets/logs'];
foreach ($others as $path) {
    $p = $viewsDir . $path . '.blade.php'; ensureDir($p);
    file_put_contents($p, <<<HTML
@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-2xl mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100 capitalize">Module Configuration</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-10 text-center"><i class="fa-solid fa-gear text-4xl text-gray-600 mb-4"></i><h3 class="text-xl text-gray-200">System Preferences</h3><p class="text-gray-500 mt-2">Configuration UI will be built out here.</p></div>
</div>
@endsection
HTML
    );
}

foreach (['direct', 'level'] as $type) {
    $p = $viewsDir . 'commissions/' . $type . '.blade.php'; ensureDir($p);
    file_put_contents($p, <<<HTML
@extends('layouts.admin')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100 capitalize">{$type} Income Logs</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead><tr><th>User</th><th>Amount</th><th>Details</th><th>Date</th></tr></thead>
            <tbody>
                @forelse(\$logs as \$log)
                <tr>
                    <td class="font-bold">{{ \$log->user->name ?? 'System' }}</td>
                    <td class="text-green-400 font-mono">+\${{ number_format(\$log->amount, 2) }}</td>
                    <td class="text-gray-400 text-sm">{{ \$log->details ?? 'Commission payout' }}</td>
                    <td>{{ \$log->created_at->format('M d, Y H:i') }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center p-8 text-gray-500">No commissions recorded.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#334155]">{{ \$logs->links() ?? '' }}</div>
    </div>
</div>
@endsection
HTML
    );
}

echo "Admin modules generated.";
