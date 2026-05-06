@extends('layouts.user')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<style>
  .app-main { padding: 20px; }
  .table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; }
  .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; font-size: 0.875rem; }
  .table-custom tr:hover { background: #1e293b; }
</style>
<div class="tailwind-scope mt-4">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Referral History</h2>
        <p class="text-gray-400">A complete ledger of users who have joined using your referral link.</p>
    </div>

    <div class="bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-[#334155]">
        <div class="overflow-x-auto">
            <table class="w-full table-custom text-left">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Referral ID</th>
                        <th>Join Date</th>
                        <th>Status</th>
                        <th>Course Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($referrals as $ref)
                    <tr>
                        <td class="font-medium">{{ $ref->name }}</td>
                        <td class="font-mono text-indigo-400">{{ $ref->referral_code }}</td>
                        <td>{{ \Carbon\Carbon::parse($ref->created_at)->format('M d, Y h:i A') }}</td>
                        <td>
                            @if($ref->status === 'active')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-900 text-green-300 border border-green-700">Active</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-900 text-red-300 border border-red-700">Inactive</span>
                            @endif
                        </td>
                        <td>
                            @if($ref->course_completed_at)
                                <span class="text-xs text-blue-400"><i class="fa-solid fa-check-circle mr-1"></i>Completed</span>
                            @else
                                <span class="text-xs text-gray-500">In Progress</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-gray-500">
                            <i class="fa-solid fa-user-xmark text-3xl mb-3 block"></i>
                            No referrals found. Share your link to start earning!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-3 border-t border-[#334155]">
            {{ $referrals->links() }}
        </div>
    </div>
</div>
@endsection
