@extends('layouts.user')

@section('content')
<div class="tailwind-scope mt-10 max-w-6xl mx-auto">
    @if(session('success'))
        <div class="bg-green-900/40 border border-green-500/50 text-green-300 px-4 py-3 rounded-lg mb-6 flex items-center gap-2">
            <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-900/40 border border-red-500/50 text-red-300 px-4 py-3 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="mb-8 text-center">
        <h1 class="text-4xl font-extrabold text-white mb-3">Choose Your Learning Module</h1>
        <p class="text-gray-400 text-lg">Select a specialized module to activate your account and start your journey.</p>
    </div>

    @foreach($modules as $module)
    <div class="bg-[#1a222d] border border-indigo-500/50 rounded-2xl p-8 shadow-2xl relative overflow-hidden mb-8">
        <!-- NGO Sponsorship Ribbon -->
        <div class="absolute top-6 -right-12 bg-yellow-500 text-black font-bold py-1 px-14 transform rotate-45 shadow-lg">
            NGO SPONSORED
        </div>

        <div class="flex flex-col md:flex-row gap-8 items-center">
            
            <!-- Details Section -->
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <span class="bg-indigo-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Required For Activation</span>
                </div>
                <h2 class="text-3xl font-extrabold text-white mb-3">{{ $module->name }}</h2>
                <p class="text-gray-400 text-md mb-6">{{ $module->description ?? 'Unlock your account with this specialized module.' }}</p>
                
                <h3 class="text-lg font-bold text-gray-200 mb-3 border-b border-[#334155] pb-2">Included Courses</h3>
                <div class="space-y-3 mb-4">
                    @forelse($module->courses->where('status', 'active') as $c)
                        <div class="flex items-start gap-3">
                            <div class="mt-1 bg-green-500/20 text-green-400 p-1 rounded-full text-xs"><i class="fa-solid fa-check"></i></div>
                            <div>
                                <h4 class="text-gray-200 font-bold text-sm">{{ $c->title }}</h4>
                            </div>
                        </div>
                    @empty
                        <div class="text-yellow-500 text-sm italic">Courses are being added to this module.</div>
                    @endforelse
                </div>
            </div>

            <!-- Pricing & Action Section -->
            <div class="w-full md:w-1/3 bg-[#0b1220] border border-[#334155] rounded-xl p-6 text-center shadow-inner">
                <p class="text-gray-500 font-semibold uppercase tracking-widest text-sm mb-2">Module Value</p>
                <div class="text-3xl text-gray-400 line-through decoration-red-500/50 font-bold mb-1">$600.00</div>
                
                <div class="bg-green-900/30 border border-green-500/30 rounded-lg p-3 my-4">
                    <p class="text-green-400 text-sm font-bold uppercase mb-1">NGO Sponsored Price</p>
                    <div class="text-5xl text-white font-black">$300<span class="text-xl text-gray-400 font-normal">.00</span></div>
                </div>

                <div class="flex justify-between items-center text-sm text-gray-400 mb-6 px-2 border-t border-[#334155] pt-4">
                    <span>Your Wallet:</span>
                    <span class="{{ $balance >= 300 ? 'text-green-400' : 'text-red-400' }} font-bold">${{ number_format($balance, 2) }}</span>
                </div>

                @if($user->status === 'active')
                    <div class="w-full py-3 bg-green-600 text-white font-bold rounded-lg shadow cursor-not-allowed">
                        <i class="fa-solid fa-check-circle mr-2"></i> Account Activated
                    </div>
                @else
                    @if($balance >= 300)
                        <form action="{{ route('package.purchase') }}" method="POST" onsubmit="return confirm('Deduct $300 from your Package Wallet to activate your account with the {{ addslashes($module->name) }} module?');">
                            @csrf
                            <input type="hidden" name="module_id" value="{{ $module->id }}">
                            <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg shadow-lg transition flex justify-center items-center gap-2 text-lg">
                                <i class="fa-solid fa-unlock"></i> Activate with this Module
                            </button>
                        </form>
                    @else
                        <button disabled class="w-full py-3 bg-gray-800 text-gray-500 font-bold rounded-lg cursor-not-allowed border border-gray-700 flex justify-center items-center gap-2">
                            <i class="fa-solid fa-lock"></i> Insufficient Funds
                        </button>
                        <p class="text-xs text-red-400 mt-3 text-center">You need ${{ number_format(300 - $balance, 2) }} more.</p>
                    @endif
                @endif
            </div>
        </div>
    </div>
    @endforeach

    @if($modules->isEmpty())
        <div class="bg-[#1a222d] border border-[#334155] rounded-xl p-8 text-center text-gray-400">
            No modules are currently available for activation. Please contact support.
        </div>
    @endif
</div>
@endsection