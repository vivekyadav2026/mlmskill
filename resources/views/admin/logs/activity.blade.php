@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-6xl mx-auto">
  <div class="flex justify-between items-center mb-6">
    <div>
      <h2 class="text-2xl font-bold text-gray-100">Activity Logs</h2>
      <p class="text-gray-400 text-sm">Monitor user and admin actions within the system.</p>
    </div>
  </div>

  <div class="bg-[#1a222d] border border-[#334155] rounded-xl overflow-hidden shadow-sm">
    <div class="bg-[#0f172a] px-5 py-4 border-b border-[#334155] flex justify-between items-center">
      <h3 class="text-gray-200 font-semibold text-lg flex items-center gap-2">
        <i class="fa-solid fa-list-check text-indigo-400"></i> Recent Activities
      </h3>
    </div>
    
    <div class="overflow-x-auto">
      <table class="w-full text-left text-sm text-gray-300">
        <thead class="bg-[#0f172a] text-gray-400 text-xs uppercase border-b border-[#334155]">
          <tr>
            <th class="px-5 py-3 font-semibold">Time</th>
            <th class="px-5 py-3 font-semibold">User</th>
            <th class="px-5 py-3 font-semibold">Action</th>
            <th class="px-5 py-3 font-semibold">Description</th>
            <th class="px-5 py-3 font-semibold">IP Address</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-[#1e293b]">
          @forelse($logs as $log)
          <tr class="hover:bg-[#1e293b] transition">
            <td class="px-5 py-3 whitespace-nowrap text-xs text-gray-400">
              {{ $log->created_at->format('Y-m-d H:i:s') }}
            </td>
            <td class="px-5 py-3">
              @if($log->user)
                <span class="text-indigo-400 font-medium">{{ $log->user->name }}</span>
                <span class="text-xs text-gray-500 block">{{ $log->user->email }}</span>
              @else
                <span class="text-gray-500 italic">System / Guest</span>
              @endif
            </td>
            <td class="px-5 py-3">
              <span class="bg-gray-800 text-gray-300 border border-gray-600 px-2 py-1 rounded text-xs font-mono">
                {{ $log->action }}
              </span>
            </td>
            <td class="px-5 py-3">{{ $log->description }}</td>
            <td class="px-5 py-3 text-xs text-gray-500 font-mono">{{ $log->ip_address ?? 'N/A' }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="px-5 py-10 text-center text-gray-500">
              <i class="fa-solid fa-clipboard-list text-3xl mb-3 block text-gray-600"></i>
              No activities logged yet.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    
    @if($logs->hasPages())
    <div class="p-4 border-t border-[#334155]">
      {{ $logs->links() }}
    </div>
    @endif
  </div>
</div>
@endsection