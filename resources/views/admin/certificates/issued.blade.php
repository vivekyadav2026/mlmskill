@extends('layouts.admin')

@section('content')
<style>
  .table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; }
  .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }
</style>

<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Issued Certificates</h2>
        <a href="{{ route('admin.certificates.generate') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded shadow transition"><i class="fa-solid fa-plus mr-1"></i> Generate New</a>
    </div>

    @if (session('success'))
    <div class="bg-green-900 border-l-4 border-green-500 text-green-200 p-4 mb-6">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden shadow-lg">
        <table class="w-full table-custom">
            <thead>
                <tr>
                    <th>Certificate Number</th>
                    <th>Student Name</th>
                    <th>Course Title</th>
                    <th>Issue Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($certificates as $cert)
                <tr class="hover:bg-[#1e293b] transition">
                    <td class="font-mono text-indigo-400 font-bold">{{ $cert->certificate_number }}</td>
                    <td class="font-medium text-gray-200">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-full bg-blue-900 text-blue-400 flex items-center justify-center font-bold text-[10px]">
                                {{ substr($cert->user->name ?? 'U', 0, 1) }}
                            </div>
                            {{ $cert->user->name ?? 'Deleted User' }}
                        </div>
                    </td>
                    <td class="font-semibold text-gray-300">{{ $cert->course->title ?? 'Deleted Course' }}</td>
                    <td class="text-gray-400">{{ $cert->issue_date->format('M d, Y h:i A') }}</td>
                    <td>
                        <span class="bg-green-900/50 border border-green-500/50 text-green-400 px-2 py-1 rounded text-xs font-medium">
                            <i class="fa-solid fa-check-circle mr-1"></i> {{ ucfirst($cert->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="flex gap-2">
                            <form action="{{ route('admin.certificates.destroy', $cert->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to revoke and delete this certificate?');">
                                @csrf
                                <button type="submit" class="text-red-400 hover:text-red-300 px-2" title="Revoke/Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center p-12 text-gray-500">
                        <i class="fa-solid fa-certificate text-4xl mb-3 block text-gray-600"></i>
                        No certificates have been issued yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-end">
        {{ $certificates->links('pagination::tailwind') }}
    </div>
</div>
@endsection