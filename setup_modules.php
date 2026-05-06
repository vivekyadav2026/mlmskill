<?php

$controllersDir = __DIR__ . '/app/Http/Controllers/';
$viewsDir = __DIR__ . '/resources/views/user/';

// 1. PackageController
$packageCtrl = <<<PHP
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    public function upgrade()
    {
        \$user = Auth::user();
        \$balance = \$user->wallet->package_wallet ?? 0;
        return view('user.package.upgrade', compact('user', 'balance'));
    }

    public function history()
    {
        \$user = Auth::user();
        // Assuming a package_purchases table or just use user activation dates for now
        return view('user.package.history', compact('user'));
    }
}
PHP;
file_put_contents($controllersDir . 'PackageController.php', $packageCtrl);

// 2. WithdrawController
$withdrawCtrl = <<<PHP
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Withdrawal;

class WithdrawController extends Controller
{
    public function request()
    {
        \$user = Auth::user();
        \$balance = \$user->wallet->income_wallet ?? 0;
        return view('user.withdraw.request', compact('user', 'balance'));
    }

    public function submit(Request \$request)
    {
        \$request->validate([
            'amount' => 'required|numeric|min:10'
        ]);
        // Demo mode logic
        return redirect()->back()->with('success', 'Withdrawal request submitted successfully! Pending admin approval.');
    }

    public function history()
    {
        \$user = Auth::user();
        \$withdrawals = Withdrawal::where('user_id', \$user->id)->orderBy('created_at', 'desc')->paginate(15);
        return view('user.withdraw.history', compact('withdrawals'));
    }
}
PHP;
file_put_contents($controllersDir . 'WithdrawController.php', $withdrawCtrl);

// 3. ReportController
$reportCtrl = <<<PHP
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CommissionLedger;
use App\Models\TokenLedger;

class ReportController extends Controller
{
    public function income()
    {
        \$user = Auth::user();
        \$reports = CommissionLedger::where('user_id', \$user->id)->orderBy('created_at', 'desc')->paginate(15);
        return view('user.reports.income', compact('reports'));
    }

    public function token()
    {
        \$user = Auth::user();
        \$reports = TokenLedger::where('user_id', \$user->id)->orderBy('created_at', 'desc')->paginate(15);
        return view('user.reports.token', compact('reports'));
    }

    public function transaction()
    {
        return view('user.reports.transaction');
    }
}
PHP;
file_put_contents($controllersDir . 'ReportController.php', $reportCtrl);

// 4. NotificationController
$notificationCtrl = <<<PHP
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function system() { return view('user.notifications.system'); }
    public function announcements() { return view('user.notifications.announcements'); }
}
PHP;
file_put_contents($controllersDir . 'NotificationController.php', $notificationCtrl);

// Generate Basic Views
$pages = [
    'package/upgrade' => 'Package Upgrade',
    'package/history' => 'Package History',
    'withdraw/request' => 'Request Withdrawal',
    'withdraw/history' => 'Withdrawal History',
    'reports/income' => 'Income Report',
    'reports/token' => 'Token Report',
    'reports/transaction' => 'Transaction Report',
    'notifications/system' => 'System Notifications',
    'notifications/announcements' => 'Announcements',
    'settings/account' => 'Account Settings',
    'settings/security' => 'Security Settings'
];

foreach ($pages as $path => $title) {
    $fullPath = $viewsDir . $path . '.blade.php';
    if (!is_dir(dirname($fullPath))) {
        mkdir(dirname($fullPath), 0777, true);
    }
    
    // Custom designs for important pages
    if ($path === 'package/upgrade') {
        $html = <<<HTML
@extends('layouts.user')
@section('content')
<div class="tailwind-scope mt-4 max-w-4xl mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Upgrade Package</h2><p class="text-gray-400">Activate or upgrade your course package using your Package Wallet.</p></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6 mb-6 flex justify-between items-center">
        <div><p class="text-gray-400 text-sm">Package Wallet Balance</p><p class="text-3xl font-bold text-purple-400">$\{{ number_format(\$balance, 2) }}</p></div>
        <div><a href="{{ url('user/token/conversion') }}" class="text-indigo-400 hover:underline text-sm"><i class="fa-solid fa-exchange mr-1"></i> Add Funds via Conversion</a></div>
    </div>
    <div class="bg-gradient-to-br from-indigo-900 to-[#1a222d] rounded-lg shadow-lg border border-indigo-500/30 overflow-hidden text-center p-8">
        <h3 class="text-3xl font-bold text-white mb-2">SK Global Masterclass</h3>
        <p class="text-gray-300 mb-6 max-w-lg mx-auto">Unlock your earning potential, full network tracking, and comprehensive skill training.</p>
        <div class="text-5xl font-bold text-white mb-8">$300 <span class="text-lg font-normal text-gray-400">/ lifetime</span></div>
        <form onsubmit="event.preventDefault(); alert('Insufficient Package Wallet balance or already active.');"><button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-full shadow-lg transition">Activate Account Now</button></form>
    </div>
</div>
@endsection
HTML;
    } elseif ($path === 'withdraw/request') {
        $html = <<<HTML
@extends('layouts.user')
@section('content')
<div class="tailwind-scope mt-4 max-w-2xl mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Request Withdrawal</h2></div>
    @if(session('success')) <div class="bg-green-500/10 text-green-400 p-4 rounded mb-4">{{ session('success') }}</div> @endif
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-8">
        <div class="mb-6 bg-green-900/20 border border-green-500/30 p-4 rounded-lg flex justify-between"><span class="text-gray-300">Withdrawable Balance:</span><span class="text-green-400 font-bold text-xl">$\{{ number_format(\$balance, 2) }}</span></div>
        <form action="{{ route('withdraw.submit') }}" method="POST">
            @csrf
            <div class="mb-4"><label class="block text-gray-300 mb-2">Amount ($)</label><input type="number" name="amount" min="10" max="{{ \$balance }}" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required></div>
            <div class="mb-6"><label class="block text-gray-300 mb-2">Payment Method</label><select class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded"><option>USDT (TRC20)</option><option>Bank Transfer</option></select></div>
            <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 rounded">Submit Request</button>
        </form>
    </div>
</div>
@endsection
HTML;
    } elseif ($path === 'withdraw/history') {
        $html = <<<HTML
@extends('layouts.user')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }</style>
<div class="tailwind-scope mt-4"><h2 class="text-2xl font-bold text-gray-100 mb-6">Withdrawal History</h2>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom"><thead><tr><th>Date</th><th>Amount</th><th>Status</th></tr></thead>
        <tbody>@forelse(\$withdrawals as \$w) <tr><td>{{ \$w->created_at->format('M d, Y') }}</td><td class="font-bold text-gray-200">$\{{ number_format(\$w->amount, 2) }}</td><td><span class="text-xs px-2 py-1 rounded bg-{{ \$w->status=='approved'?'green':'yellow' }}-900 text-{{ \$w->status=='approved'?'green':'yellow' }}-300">{{ ucfirst(\$w->status) }}</span></td></tr> @empty <tr><td colspan="3" class="text-center p-8 text-gray-500">No withdrawals yet</td></tr> @endforelse</tbody></table>
        <div class="p-4 border-t border-[#334155]">{{ \$withdrawals->links() }}</div>
    </div>
</div>
@endsection
HTML;
    } else {
        $html = <<<HTML
@extends('layouts.user')
@section('content')
<div class="tailwind-scope mt-4"><h2 class="text-2xl font-bold text-gray-100 mb-6">$title</h2>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-10 text-center"><i class="fa-solid fa-check-circle text-4xl text-green-500 mb-4"></i><h3 class="text-xl text-gray-200">Module Active</h3><p class="text-gray-500 mt-2">Data will populate here automatically.</p></div>
</div>
@endsection
HTML;
    }
    file_put_contents($fullPath, $html);
}

echo "Controllers and Views generated.";
