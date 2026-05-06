@extends('layouts.user')

@section('content')

<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4 max-w-3xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Edit Profile</h2>
        <p class="text-gray-400">Update your personal information.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-[#334155]">
        <form action="{{ route('profile.update') }}" method="POST" class="p-8">
            @csrf
            
            <div class="flex items-center space-x-6 mb-8">
                <div class="h-20 w-20 rounded-full bg-indigo-500 flex items-center justify-center text-white text-3xl font-bold border-4 border-[#0b1220] shadow-lg">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div>
                    <h3 class="text-xl font-medium text-white">{{ auth()->user()->name }}</h3>
                    <p class="text-gray-400">Referral Code: <span class="text-indigo-400 font-mono">{{ auth()->user()->referral_code }}</span></p>
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" class="w-full bg-[#0b1220] border border-[#334155] rounded-md shadow-sm py-2 px-3 text-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('name') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" class="w-full bg-[#0b1220] border border-[#334155] rounded-md shadow-sm py-2 px-3 text-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('email') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Sponsor ID</label>
                    <input type="text" disabled value="{{ auth()->user()->sponsor_id }}" class="w-full bg-[#111827] border border-[#334155] rounded-md shadow-sm py-2 px-3 text-gray-500 cursor-not-allowed">
                    <p class="text-xs text-gray-500 mt-1">Sponsor ID cannot be changed after registration.</p>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-[#334155] flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-md shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-[#1a222d] transition-colors">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
