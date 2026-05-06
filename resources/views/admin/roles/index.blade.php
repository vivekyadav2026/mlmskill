@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-3xl mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">{$title}</h2></div>
    
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-10 text-center shadow-lg">
        <div class="w-20 h-20 mx-auto bg-indigo-900/30 border border-indigo-500/50 rounded-full flex items-center justify-center mb-6">
            <i class="fa-solid {$icon} text-4xl text-indigo-400"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-200 mb-2">Module Initialized</h3>
        <p class="text-gray-400 mb-8 max-w-md mx-auto">{$desc}</p>
        
        <div class="bg-[#0b1220] border border-[#334155] rounded p-4 text-left font-mono text-sm text-green-400 shadow-inner">
            <p>> Loading dependencies for {$title}...</p>
            <p>> Connecting to database cluster...</p>
            <p>> Access granted. Interface ready for data binding.</p>
        </div>
    </div>
</div>
@endsection