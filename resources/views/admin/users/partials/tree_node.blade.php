<li>
    <div class="flex items-center my-2 p-2 bg-[#0f172a] border border-[#334155] rounded-lg shadow-sm hover:border-indigo-500 transition w-max">
        <i class="fa-solid fa-user text-indigo-400 mr-3 text-lg"></i> 
        <div>
            <div class="font-bold text-gray-200 text-sm">{{ $user->name }}</div>
            <div class="text-xs text-gray-500 font-mono">{{ $user->referral_code }}</div>
        </div>
        <div class="ml-4 pl-4 border-l border-[#334155]">
            @if($user->status === 'active')
                <span class="bg-green-900/50 text-green-400 border border-green-500 px-2 py-0.5 rounded text-[10px] font-semibold uppercase tracking-wider">Active</span>
            @else
                <span class="bg-red-900/50 text-red-400 border border-red-500 px-2 py-0.5 rounded text-[10px] font-semibold uppercase tracking-wider">Inactive</span>
            @endif
        </div>
    </div>
    @if($user->allReferrals && $user->allReferrals->count() > 0)
        <ul class="list-none ml-6 border-l border-indigo-500/30 pl-6 mt-2 relative before:content-[''] before:absolute before:top-0 before:left-[-1px] before:w-[1px] before:h-full before:bg-indigo-500/30">
            @foreach($user->allReferrals as $child)
                @include('admin.users.partials.tree_node', ['user' => $child])
            @endforeach
        </ul>
    @endif
</li>
