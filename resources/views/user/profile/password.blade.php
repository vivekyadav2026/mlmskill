@extends('layouts.user')

@section('content')

<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4 max-w-3xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Change Password</h2>
        <p class="text-gray-400">Ensure your account is using a long, random password to stay secure.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-[#334155]">
        <form action="{{ route('profile.password.update') }}" method="POST" class="p-8">
            @csrf
            
            <div class="space-y-6">
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-300 mb-1">Current Password</label>
                    <input type="password" name="current_password" id="current_password" class="w-full bg-[#0b1220] border border-[#334155] rounded-md shadow-sm py-2 px-3 text-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('current_password') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-1">New Password</label>
                    <input type="password" name="password" id="password" class="w-full bg-[#0b1220] border border-[#334155] rounded-md shadow-sm py-2 px-3 text-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                    @error('password') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full bg-[#0b1220] border border-[#334155] rounded-md shadow-sm py-2 px-3 text-gray-100 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-[#334155] flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-md shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-[#1a222d] transition-colors">
                    Update Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
