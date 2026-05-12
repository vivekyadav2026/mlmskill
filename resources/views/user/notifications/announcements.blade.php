@extends('layouts.user')

@section('content')
<div class="tailwind-scope mt-4 max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">Global Announcements</h2>
            <p class="text-gray-400 text-sm">Important updates and broadcasts from the admin team.</p>
        </div>
    </div>

    <div class="space-y-4">
        @forelse($announcements as $announcement)
            @php
                $bgClass = 'bg-[#1a222d] border-[#334155]';
                $iconClass = 'text-blue-400 fa-circle-info';
                
                if($announcement->type == 'warning') {
                    $bgClass = 'bg-yellow-900/10 border-yellow-500/30';
                    $iconClass = 'text-yellow-500 fa-triangle-exclamation';
                } elseif($announcement->type == 'success') {
                    $bgClass = 'bg-green-900/10 border-green-500/30';
                    $iconClass = 'text-green-500 fa-circle-check';
                } elseif($announcement->type == 'danger') {
                    $bgClass = 'bg-red-900/10 border-red-500/30';
                    $iconClass = 'text-red-500 fa-circle-xmark';
                }
            @endphp
            
            <div class="{{ $bgClass }} border rounded-lg p-6 shadow-lg relative overflow-hidden transition hover:shadow-xl">
                <div class="flex gap-4">
                    <div class="mt-1 shrink-0">
                        <i class="fa-solid {{ $iconClass }} text-2xl"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-xl font-bold text-gray-200">{{ $announcement->title }}</h3>
                            <span class="text-xs text-gray-500 whitespace-nowrap"><i class="fa-regular fa-clock mr-1"></i> {{ $announcement->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="text-gray-400 leading-relaxed prose prose-invert max-w-none">
                            {!! nl2br(e($announcement->content)) !!}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-12 text-center text-gray-500 shadow-lg">
                <i class="fa-solid fa-bullhorn text-4xl mb-3 block text-gray-600"></i>
                <p>No active announcements at this time.</p>
            </div>
        @endforelse
    </div>

    @if($announcements->hasPages())
    <div class="mt-6 flex justify-center">
        {{ $announcements->links() }}
    </div>
    @endif
</div>
@endsection