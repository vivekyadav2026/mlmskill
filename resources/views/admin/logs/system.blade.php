@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-6xl mx-auto">
  <div class="flex justify-between items-center mb-6">
    <div>
      <h2 class="text-2xl font-bold text-gray-100">System Logs</h2>
      <p class="text-gray-400 text-sm">Raw laravel system logs (last 500 lines).</p>
    </div>
    <form action="{{ url('admin/logs/system/clear') }}" method="POST" onsubmit="return confirm('Clear all system logs?');">
      @csrf
      <button class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow transition text-sm font-semibold">
        <i class="fa-solid fa-trash mr-1"></i> Clear Logs
      </button>
    </form>
  </div>

  @if(session('success'))
    <div class="bg-green-900/40 border border-green-500/50 text-green-300 px-4 py-3 rounded-lg mb-4 flex items-center gap-2">
      <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
    </div>
  @endif

  <div class="bg-[#1a222d] border border-[#334155] rounded-xl overflow-hidden shadow-sm">
    <div class="bg-[#0f172a] px-5 py-3 border-b border-[#334155] flex items-center gap-2">
      <i class="fa-solid fa-terminal text-green-400"></i>
      <h3 class="text-gray-200 font-semibold">storage/logs/laravel.log</h3>
    </div>
    
    <div class="p-4 bg-black overflow-x-auto" style="max-height: 70vh; overflow-y: auto;">
      <pre class="text-xs font-mono whitespace-pre-wrap leading-relaxed">
@forelse($logs as $line)
@php
  // Simple syntax highlighting for logs
  $lineClass = 'text-gray-400';
  if (strpos($line, 'local.ERROR:') !== false || strpos($line, 'production.ERROR:') !== false) $lineClass = 'text-red-400 font-bold';
  elseif (strpos($line, 'local.INFO:') !== false) $lineClass = 'text-blue-400';
  elseif (strpos($line, 'local.WARNING:') !== false) $lineClass = 'text-yellow-400';
  elseif (strpos($line, 'Stack trace:') !== false) $lineClass = 'text-orange-400 italic';
@endphp<span class="{{ $lineClass }}">{{ $line }}</span>@empty<span class="text-gray-500 italic">Log file is empty or does not exist.</span>@endforelse
      </pre>
    </div>
  </div>
</div>
@endsection