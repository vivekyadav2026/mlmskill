@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-2xl mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Create New User</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6">
        <form method="POST" action="{{ url('admin/users/create') }}">
            @csrf
            <div class="mb-4"><label class="block text-gray-300 mb-2">Name</label><input type="text" name="name" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required></div>
            <div class="mb-4"><label class="block text-gray-300 mb-2">Email</label><input type="email" name="email" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required></div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-2">Sponsor ID (Referral Code)</label>
                <input type="text" name="sponsor_id" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" value="{{ auth()->user()->referral_code }}" required>
                <p class="text-xs text-gray-500 mt-1">Leave as default to place this user directly under the Admin account.</p>
            </div>
            <div class="mb-6"><label class="block text-gray-300 mb-2">Password</label><input type="password" name="password" minlength="6" maxlength="8" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required></div>
            <button class="bg-indigo-600 text-white px-6 py-2 rounded font-bold">Create Account</button>
        </form>
    </div>
</div>
@endsection