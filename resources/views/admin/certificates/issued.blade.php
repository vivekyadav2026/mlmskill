@extends('layouts.admin')
@section('content')
<style>
  .table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; font-size: 0.75rem; text-transform: uppercase; }
  .table-custom td { padding: 0.9rem 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; font-size: 0.875rem; }
  .table-custom tr:hover { background: #1e293b; }
</style>

<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">
    <div class="flex flex-wrap justify-between items-center mb-6 gap-3">
        <div>
            <h2 class="text-2xl font-bold text-gray-100"><i class="fa-solid fa-certificate mr-2 text-yellow-400"></i>Issued Certificates</h2>
            <p class="text-gray-400 text-sm mt-1">Total: <span class="text-white font-semibold">{{ $certificates->total() }}</span> certificates</p>
        </div>
        <a href="{{ route('admin.certificates.generate') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded shadow transition flex items-center gap-2 relative">
            <i class="fa-solid fa-plus"></i> Issue New Certificate
            @if($pendingCount > 0)
            <span class="ml-1 bg-yellow-400 text-yellow-900 text-xs font-bold px-1.5 py-0.5 rounded-full">{{ $pendingCount }}</span>
            @endif
        </a>
    </div>

    @if (session('success'))
    <div class="bg-green-900/60 border border-green-500/50 text-green-300 p-4 mb-5 rounded-lg flex items-center gap-2">
        <i class="fa-solid fa-check-circle text-green-400"></i> {{ session('success') }}
    </div>
    @endif
    @if (session('error'))
    <div class="bg-red-900/60 border border-red-500/50 text-red-300 p-4 mb-5 rounded-lg flex items-center gap-2">
        <i class="fa-solid fa-triangle-exclamation text-red-400"></i> {{ session('error') }}
    </div>
    @endif

    {{-- Search Bar --}}
    <form method="GET" action="{{ route('admin.certificates.issued') }}" class="mb-5 flex gap-2">
        <div class="relative flex-1">
            <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm"></i>
            <input type="text" name="q" value="{{ $q ?? '' }}"
                placeholder="Search by name, email, ID, cert number or course..."
                class="w-full bg-[#1a222d] border border-[#334155] text-white pl-9 pr-4 py-2.5 rounded-lg focus:outline-none focus:border-indigo-500 transition text-sm">
        </div>
        <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm transition">Search</button>
        @if($q)
        <a href="{{ route('admin.certificates.issued') }}" class="px-4 py-2.5 bg-gray-700 hover:bg-gray-600 text-white rounded-lg text-sm transition">Clear</a>
        @endif
    </form>

    @if($q)
    <p class="text-gray-400 text-sm mb-4">Showing results for: <span class="text-indigo-400 font-medium">"{{ $q }}"</span> — {{ $certificates->total() }} found</p>
    @endif

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden shadow-lg">
        <table class="w-full table-custom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Certificate Number</th>
                    <th>Student</th>
                    <th>Module</th>
                    <th>Issue Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($certificates as $i => $cert)
                <tr class="hover:bg-[#1e293b] transition">
                    <td class="text-gray-500 text-xs">{{ $certificates->firstItem() + $i }}</td>
                    <td class="font-mono text-indigo-400 font-bold text-sm">{{ $cert->certificate_number }}</td>
                    <td>
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-blue-900 text-blue-300 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                {{ strtoupper(substr($cert->user->name ?? 'U', 0, 1)) }}
                            </div>
                            <div>
                                <div class="font-medium text-gray-200 text-sm">{{ $cert->user->name ?? 'Deleted User' }}</div>
                                <div class="text-xs text-gray-500">{{ $cert->user->referral_code ?? '' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="text-gray-300">
                        <span class="bg-indigo-900/40 border border-indigo-700/40 text-indigo-300 px-2 py-0.5 rounded text-xs font-medium">
                            <i class="fa-solid fa-layer-group mr-1"></i>{{ $cert->module->name ?? ($cert->course->title ?? 'N/A') }}
                        </span>
                    </td>
                    <td class="text-gray-400 text-sm whitespace-nowrap">{{ $cert->issue_date->format('d M Y') }}<br><span class="text-xs text-gray-600">{{ $cert->issue_date->format('h:i A') }}</span></td>
                    <td>
                        <span class="bg-green-900/50 border border-green-500/50 text-green-400 px-2 py-1 rounded text-xs font-medium">
                            <i class="fa-solid fa-check-circle mr-1"></i>{{ ucfirst($cert->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="flex gap-2 items-center">
                            <a href="{{ route('admin.certificates.preview', $cert->id) }}" target="_blank"
                               class="px-3 py-1 bg-indigo-900/60 hover:bg-indigo-700 text-indigo-300 hover:text-white border border-indigo-700/50 rounded text-xs transition" title="Preview Certificate">
                                <i class="fa-solid fa-eye mr-1"></i>Preview
                            </a>
                            <form action="{{ route('admin.certificates.destroy', $cert->id) }}" method="POST"
                                  onsubmit="return confirm('Revoke and delete this certificate?');">
                                @csrf
                                <button type="submit" class="px-3 py-1 bg-red-900/50 hover:bg-red-700 text-red-400 hover:text-white border border-red-700/50 rounded text-xs transition" title="Revoke">
                                    <i class="fa-solid fa-trash mr-1"></i>Revoke
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center p-16 text-gray-500">
                        <i class="fa-solid fa-certificate text-5xl mb-4 block text-gray-700"></i>
                        @if($q)
                            No certificates found matching <strong>"{{ $q }}"</strong>.
                        @else
                            No certificates have been issued yet.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-end">
        {{ $certificates->links('pagination::tailwind') }}
    </div>
</div>
@endsection