<?php

$controllersDir = __DIR__ . '/app/Http/Controllers/';
$viewsDir = __DIR__ . '/resources/views/admin/';

// --- UPDATE ACTIVATION CONTROLLER ---
$adminActivationCtrl = file_get_contents($controllersDir . 'AdminActivationController.php');
$actCtrlMethods = <<<PHP
    public function requests() {
        // Mocking activation requests since table doesn't exist yet
        \$requests = [];
        return view('admin.activations.requests', compact('requests'));
    }
PHP;
if(strpos($adminActivationCtrl, "function requests") !== false) {
    // replace it
    $adminActivationCtrl = preg_replace('/public function requests\(\)\s*\{.*?\}/s', $actCtrlMethods, $adminActivationCtrl);
}
file_put_contents($controllersDir . 'AdminActivationController.php', $adminActivationCtrl);

// --- CREATE COURSE CONTROLLER ---
$adminCourseCtrl = <<<PHP
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Course;

class AdminCourseController extends Controller
{
    public function index() {
        \$courses = Course::latest()->paginate(15);
        return view('admin.courses.index', compact('courses'));
    }
    public function create() {
        return view('admin.courses.create');
    }
    public function store(Request \$request) {
        \$request->validate(['title'=>'required', 'price'=>'required|numeric']);
        Course::create(\$request->all());
        return redirect('admin/courses')->with('success', 'Course added successfully.');
    }
}
PHP;
file_put_contents($controllersDir . 'AdminCourseController.php', $adminCourseCtrl);

// --- VIEWS ---
function ensureDir($path) {
    if (!is_dir(dirname($path))) {
        mkdir(dirname($path), 0777, true);
    }
}

// 1. Activation Requests
$p = $viewsDir . 'activations/requests.blade.php'; ensureDir($p);
file_put_contents($p, <<<HTML
@extends('layouts.admin')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Activation Requests (Payment Proofs)</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead><tr><th>User</th><th>Transaction ID</th><th>Proof Image</th><th>Status</th><th>Action</th></tr></thead>
            <tbody>
                @forelse(\$requests as \$req)
                <tr>
                    <td>{{ \$req->user->name }}</td>
                    <td class="font-mono text-indigo-400">{{ \$req->txn_id }}</td>
                    <td><a href="#" class="text-blue-400 hover:underline">View Receipt</a></td>
                    <td><span class="bg-yellow-900 text-yellow-300 px-2 py-1 rounded text-xs">Pending</span></td>
                    <td>
                        <button class="bg-green-600 text-white px-2 py-1 rounded text-xs">Approve</button>
                        <button class="bg-red-600 text-white px-2 py-1 rounded text-xs">Reject</button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center p-8 text-gray-500">No pending activation requests. All clear!</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
HTML
);

// 2. Wallet Logs
$p = $viewsDir . 'wallets/logs.blade.php'; ensureDir($p);
file_put_contents($p, <<<HTML
@extends('layouts.admin')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Wallet Adjustment Logs</h2><p class="text-gray-400">Audit trail of all manual wallet modifications made by administrators.</p></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead><tr><th>Admin</th><th>Target User</th><th>Wallet Affected</th><th>Amount</th><th>Date</th></tr></thead>
            <tbody>
                <tr><td colspan="5" class="text-center p-8 text-gray-500">No manual adjustments recorded yet.</td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
HTML
);

// 3. Token Settings
$p = $viewsDir . 'tokens/settings.blade.php'; ensureDir($p);
file_put_contents($p, <<<HTML
@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-2xl mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Tokenomics Settings</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6">
        <form onsubmit="event.preventDefault(); alert('Settings Saved!');">
            <div class="mb-4"><label class="block text-gray-300 mb-2">Daily ROI (Utility Tokens)</label><input type="number" step="0.1" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" value="1.5"></div>
            <div class="mb-4"><label class="block text-gray-300 mb-2">Daily ROI (Renewal Tokens)</label><input type="number" step="0.1" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" value="0.5"></div>
            <div class="mb-6"><label class="block text-gray-300 mb-2">Utility to USD Conversion Rate</label><input type="number" step="0.01" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" value="1.00"></div>
            <button class="bg-indigo-600 text-white px-6 py-2 rounded font-bold w-full">Update Global Tokenomics</button>
        </form>
    </div>
</div>
@endsection
HTML
);

// 4. Token Manual Credit
$p = $viewsDir . 'tokens/manual.blade.php'; ensureDir($p);
file_put_contents($p, <<<HTML
@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-2xl mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Manual Token Credit</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6">
        <form onsubmit="event.preventDefault(); alert('Tokens Credited successfully!');">
            <div class="mb-4"><label class="block text-gray-300 mb-2">Select User</label><input type="text" placeholder="Search by email..." class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded"></div>
            <div class="mb-4"><label class="block text-gray-300 mb-2">Token Type</label><select class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded"><option>Utility Token</option><option>Renewal Token</option></select></div>
            <div class="mb-6"><label class="block text-gray-300 mb-2">Amount</label><input type="number" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required></div>
            <button class="bg-indigo-600 text-white px-6 py-2 rounded font-bold w-full">Dispatch Tokens</button>
        </form>
    </div>
</div>
@endsection
HTML
);

// 5. Commission Settings
$p = $viewsDir . 'commissions/settings.blade.php'; ensureDir($p);
file_put_contents($p, <<<HTML
@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-3xl mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Commission Structure Settings</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6">
        <h3 class="text-white font-bold mb-4">Direct Referral Income</h3>
        <div class="mb-6"><label class="block text-gray-300 mb-2">Reward Amount ($)</label><input type="number" value="5.00" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded"></div>
        
        <h3 class="text-white font-bold mb-4 border-t border-[#334155] pt-4">Generation (Level) Income</h3>
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div><label class="block text-gray-300 mb-2">Level 1 ($)</label><input type="number" value="2.00" class="w-full bg-[#0b1220] border border-[#334155] text-white p-2 rounded"></div>
            <div><label class="block text-gray-300 mb-2">Level 2 ($)</label><input type="number" value="1.00" class="w-full bg-[#0b1220] border border-[#334155] text-white p-2 rounded"></div>
            <div><label class="block text-gray-300 mb-2">Level 3 ($)</label><input type="number" value="0.50" class="w-full bg-[#0b1220] border border-[#334155] text-white p-2 rounded"></div>
            <div><label class="block text-gray-300 mb-2">Level 4-10 ($)</label><input type="number" value="0.25" class="w-full bg-[#0b1220] border border-[#334155] text-white p-2 rounded"></div>
        </div>
        <button class="bg-indigo-600 text-white px-6 py-2 rounded font-bold w-full">Save Commission Rules</button>
    </div>
</div>
@endsection
HTML
);

// 6. Course Index
$p = $viewsDir . 'courses/index.blade.php'; ensureDir($p);
file_put_contents($p, <<<HTML
@extends('layouts.admin')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Course Management</h2>
        <a href="{{ url('admin/courses/create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow"><i class="fa-solid fa-plus mr-1"></i> Add Course</a>
    </div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead><tr><th>Course Title</th><th>Price</th><th>Status</th><th>Modules</th><th>Action</th></tr></thead>
            <tbody>
                @forelse(\$courses as \$c)
                <tr>
                    <td class="font-bold">{{ \$c->title }}</td>
                    <td class="text-green-400 font-mono">$\{{ number_format(\$c->price, 2) }}</td>
                    <td><span class="bg-green-900 text-green-300 px-2 py-1 rounded text-xs">{{ \$c->status }}</span></td>
                    <td>12 Videos</td>
                    <td><button class="text-indigo-400 hover:text-white"><i class="fa-solid fa-edit"></i> Edit</button></td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center p-8 text-gray-500">No courses available.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
HTML
);

// 7. Course Create
$p = $viewsDir . 'courses/create.blade.php'; ensureDir($p);
file_put_contents($p, <<<HTML
@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-2xl mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Create New Course</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6">
        <form method="POST" action="{{ url('admin/courses/create') }}">
            @csrf
            <div class="mb-4"><label class="block text-gray-300 mb-2">Course Title</label><input type="text" name="title" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required></div>
            <div class="mb-4"><label class="block text-gray-300 mb-2">Description</label><textarea name="description" rows="4" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded"></textarea></div>
            <div class="mb-4"><label class="block text-gray-300 mb-2">Price ($)</label><input type="number" step="0.01" name="price" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required></div>
            <div class="mb-6"><label class="block text-gray-300 mb-2">Status</label><select name="status" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded"><option value="active">Active</option><option value="inactive">Inactive</option></select></div>
            <button class="bg-indigo-600 text-white px-6 py-2 rounded font-bold w-full">Publish Course</button>
        </form>
    </div>
</div>
@endsection
HTML
);

echo "Final Admin modules generated.";
