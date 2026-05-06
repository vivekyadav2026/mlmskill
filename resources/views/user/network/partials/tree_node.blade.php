<li>
    <a href="javascript:void(0);">
        <div class="flex flex-col items-center">
            <div class="h-12 w-12 rounded-full flex items-center justify-center text-white font-bold text-lg {{ $node->status === 'active' ? 'bg-green-500' : 'bg-red-500' }}">
                {{ substr($node->name, 0, 1) }}
            </div>
            <div class="mt-2 font-semibold text-sm">{{ $node->name }}</div>
            <div class="text-xs text-gray-400 mt-1">{{ $node->referral_code }}</div>
        </div>
    </a>
    @if($node->referrals && $node->referrals->count() > 0)
        <ul>
            @foreach($node->referrals as $child)
                @include('user.network.partials.tree_node', ['node' => $child])
            @endforeach
        </ul>
    @endif
</li>
