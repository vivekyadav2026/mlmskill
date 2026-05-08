@extends('layouts.user')

@section('content')
<div class="tailwind-scope mt-4 max-w-2xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100"><i class="fa-solid fa-lock mr-2 text-indigo-500"></i>Manage MPIN</h2>
        <p class="text-gray-400">Update your 4-digit security PIN used for transactions.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-900/40 border border-green-500/50 text-green-300 px-4 py-3 rounded-lg mb-6 flex items-center gap-2">
            <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-900/40 border border-red-500/50 text-red-300 px-4 py-3 rounded-lg mb-6 flex items-center gap-2">
            <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-900/40 border border-red-500/50 text-red-300 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-[#1a222d] border border-[#334155] rounded-xl p-8 shadow-xl">
        <form action="{{ route('p2p.mpin.update') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-300 mb-2">Current Account Password *</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-key text-gray-500"></i>
                    </div>
                    <input type="password" name="current_password" required class="w-full bg-[#0b1220] border border-[#334155] rounded-lg pl-10 pr-4 py-3 text-white focus:outline-none focus:border-indigo-500 transition shadow-inner">
                </div>
                <p class="text-xs text-gray-500 mt-2">Required to verify your identity.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 border-t border-[#334155] pt-6">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">New 4-Digit MPIN *</label>
                    <input type="password" name="new_mpin" required maxlength="4" pattern="\d{4}" placeholder="••••" class="w-full bg-[#0b1220] border border-indigo-500/50 rounded-lg p-3 text-white text-2xl tracking-[1em] text-center focus:outline-none focus:border-indigo-500 transition shadow-inner">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Confirm New MPIN *</label>
                    <input type="password" name="new_mpin_confirmation" required maxlength="4" pattern="\d{4}" placeholder="••••" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg p-3 text-white text-2xl tracking-[1em] text-center focus:outline-none focus:border-indigo-500 transition shadow-inner">
                </div>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-lg shadow-lg transition flex justify-center items-center gap-2 text-lg">
                <i class="fa-solid fa-save"></i> Update MPIN
            </button>
        </form>
    </div>
</div>
@endsection
