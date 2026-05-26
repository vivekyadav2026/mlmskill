@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100"><i class="fa-solid fa-stamp mr-2 text-yellow-400"></i>Certificate Approval Requests</h2>
        <p class="text-gray-400 text-sm mt-1">Review and approve user course completions. Nexa 3.0 tokens are credited instantly upon approval.</p>
    </div>

    @if(session('success'))
    <div class="bg-green-900/60 border border-green-500/50 text-green-300 p-4 mb-5 rounded-lg flex items-center gap-2">
        <i class="fa-solid fa-check-circle text-green-400"></i> {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-900/60 border border-red-500/50 text-red-300 p-4 mb-5 rounded-lg flex items-center gap-2">
        <i class="fa-solid fa-triangle-exclamation text-red-400"></i> {{ session('error') }}
    </div>
    @endif

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden shadow-lg">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-[#0f172a] border-b border-[#334155]">
                    <th class="p-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">#</th>
                    <th class="p-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Student Profile</th>
                    <th class="p-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Course Module</th>
                    <th class="p-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Completion Requested Date</th>
                    <th class="p-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Verification Status</th>
                    <th class="p-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#334155]">
                @forelse($requests as $i => $req)
                <tr class="hover:bg-[#1e293b] transition">
                    <td class="p-4 text-gray-500 text-sm">{{ $requests->firstItem() + $i }}</td>
                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-indigo-900 text-indigo-300 flex items-center justify-center font-bold text-xs">
                                {{ strtoupper(substr($req->user->name ?? 'U', 0, 1)) }}
                            </div>
                            <div>
                                <div class="font-medium text-gray-200 text-sm">{{ $req->user->name ?? 'Deleted User' }}</div>
                                <div class="text-xs text-gray-500">{{ $req->user->email ?? '' }} &bull; <span class="font-mono text-indigo-400">{{ $req->user->referral_code ?? '' }}</span></div>
                            </div>
                        </div>
                    </td>
                    <td class="p-4">
                        <span class="bg-indigo-900/40 border border-indigo-700/40 text-indigo-300 px-2 py-0.5 rounded text-xs font-medium">
                            <i class="fa-solid fa-layer-group mr-1"></i>{{ $req->module->name ?? 'Default Module' }}
                        </span>
                    </td>
                    <td class="p-4 text-gray-400 text-sm">{{ $req->created_at->format('d M Y, h:i A') }}</td>
                    <td class="p-4">
                        <span class="bg-yellow-900/50 border border-yellow-500/50 text-yellow-400 px-2 py-1 rounded text-xs font-medium">
                            <i class="fa-solid fa-clock-rotate-left mr-1"></i>Pending Review
                        </span>
                    </td>
                    <td class="p-4">
                        <div class="flex gap-2">
                            <form action="{{ route('admin.certificates.approve', $req->id) }}" method="POST" onsubmit="return confirm('Approve certificate and credit Nexa 3.0 rewards?');">
                                @csrf
                                <button type="submit" class="px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white rounded text-xs transition font-semibold">
                                    <i class="fa-solid fa-check mr-1"></i>Approve
                                </button>
                            </form>
                            <form action="{{ route('admin.certificates.reject', $req->id) }}" method="POST" onsubmit="return confirm('Reject request and reset course completion?');">
                                @csrf
                                <button type="submit" class="px-3 py-1.5 bg-red-950/40 hover:bg-red-800 text-red-400 hover:text-white border border-red-700/40 rounded text-xs transition">
                                    <i class="fa-solid fa-times mr-1"></i>Reject
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center p-16 text-gray-500">
                        <i class="fa-solid fa-stamp text-5xl mb-4 block text-gray-700"></i>
                        No pending certificate approval requests found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-end">
        {{ $requests->links('pagination::tailwind') }}
    </div>
</div>
@endsection
