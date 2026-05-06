@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-2xl mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Manual User Activation</h2><p class="text-gray-400">Manually activate a user account bypassing the automated payment gateway.</p></div>
    @if(session('success')) <div class="bg-green-500/10 text-green-400 p-4 rounded mb-4">{{ session('success') }}</div> @endif
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-8">
        <form action="{{ url('admin/activations/manual') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label class="block text-gray-300 mb-2">Select Inactive User</label>
                <select name="user_id" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required>
                    <option value="">-- Choose User --</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded shadow">Activate User Account ($300 Course)</button>
        </form>
    </div>
</div>
@endsection