@extends('layouts.user')

@section('content')
<div class="tailwind-scope mt-4 max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">System Notifications</h2>
            <p class="text-gray-400 text-sm">Automated alerts and account updates.</p>
        </div>
    </div>

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg shadow-lg overflow-hidden">
        <ul class="divide-y divide-[#334155]">
            @forelse($notifications as $notification)
            <li class="p-6 hover:bg-[#1f2937] transition {{ is_null($notification->read_at) ? 'bg-[#161f2d] border-l-4 border-blue-500' : 'border-l-4 border-transparent' }}">
                <div class="flex items-start gap-4">
                    <div class="mt-1">
                        @if(is_null($notification->read_at))
                            <span class="flex h-3 w-3 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-500"></span>
                            </span>
                        @else
                            <i class="fa-solid fa-bell text-gray-500"></i>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h4 class="text-gray-200 font-medium text-lg">{{ $notification->data['title'] ?? 'System Alert' }}</h4>
                        <p class="text-gray-400 mt-1">{{ $notification->data['message'] ?? 'You have a new system notification.' }}</p>
                        <p class="text-xs text-gray-500 mt-3"><i class="fa-regular fa-clock mr-1"></i> {{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </li>
            @empty
            <li class="p-12 text-center text-gray-500">
                <i class="fa-solid fa-bell-slash text-4xl mb-3 block text-gray-600"></i>
                <p>You have no system notifications.</p>
            </li>
            @endforelse
        </ul>
        
        @if($notifications->hasPages())
        <div class="px-6 py-4 border-t border-[#334155]">
            {{ $notifications->links() }}
        </div>
        @endif
    </div>
</div>
@endsection