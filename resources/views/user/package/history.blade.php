@extends('layouts.user')

@section('content')
<style>
  .table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; }
  .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; font-size: 0.875rem; }
  .table-custom tr:hover td { background: rgba(255,255,255,0.02); }
</style>

<div class="tailwind-scope mt-4 max-w-5xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Package Purchase History</h2>
        <p class="text-gray-400 text-sm">A log of all your package activations and downline sponsorships.</p>
    </div>

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden shadow-lg">
        <div class="overflow-x-auto">
            <table class="w-full table-custom min-w-[600px]">
                <thead>
                    <tr>
                        <th class="text-left">Date</th>
                        <th class="text-left">Action</th>
                        <th class="text-left">Description</th>
                        <th class="text-right">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($history as $item)
                    <tr class="transition">
                        <td class="whitespace-nowrap text-gray-400">{{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y - H:i') }}</td>
                        <td class="whitespace-nowrap">
                            @if($item->action == 'account_activated_by_sponsor')
                                <span class="bg-blue-900/50 text-blue-400 border border-blue-500/30 px-2 py-1 rounded text-xs whitespace-nowrap">Sponsor Activation</span>
                            @else
                                <span class="bg-green-900/50 text-green-400 border border-green-500/30 px-2 py-1 rounded text-xs whitespace-nowrap">Self Activation</span>
                            @endif
                        </td>
                        <td class="text-gray-300 min-w-[200px]">{{ $item->description }}</td>
                        <td class="text-right whitespace-nowrap">
                            <span class="text-green-400 font-bold"><i class="fa-solid fa-check"></i> Completed</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center p-12 text-gray-500">
                            <i class="fa-solid fa-box-open text-4xl mb-3 block text-gray-600"></i>
                            No package activations found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($history->hasPages())
        <!-- Added pb-20 so mobile chat widgets don't overlap the Next button -->
        <div class="px-6 py-4 border-t border-[#334155] pb-24">
            {{ $history->links('pagination::simple-tailwind') }}
        </div>
        @endif
    </div>
</div>
@endsection