@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-6xl mx-auto">
  <div class="flex justify-between items-center mb-6">
    <div>
      <h2 class="text-2xl font-bold text-gray-100">Error Logs</h2>
      <p class="text-gray-400 text-sm">Filtered error logs from laravel.log.</p>
    </div>
  </div>

  <div class="bg-[#1a222d] border border-[#334155] rounded-xl overflow-hidden shadow-sm">
    <div class="bg-[#0f172a] px-5 py-3 border-b border-[#334155] flex items-center gap-2">
      <i class="fa-solid fa-triangle-exclamation text-red-500"></i>
      <h3 class="text-gray-200 font-semibold">Errors Only</h3>
    </div>
    
    <div class="p-4 bg-[#111] overflow-x-auto" style="max-height: 70vh; overflow-y: auto;">
      <pre class="text-xs font-mono whitespace-pre-wrap leading-relaxed text-red-400">
@forelse($errorLogs as $line)
{{ $line }}
@empty
<span class="text-green-400 italic">No errors found in the current log file! 🎉</span>
@endforelse
      </pre>
    </div>
  </div>
</div>
@endsection