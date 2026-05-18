@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-[800px] mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-100">Edit User</h2>
        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600">Back to Users</a>
    </div>

    @if ($errors->any())
    <div class="bg-red-900 border-l-4 border-red-500 text-red-200 p-4 mb-6">
        <ul class="list-disc ml-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="name" class="block text-gray-300 font-medium mb-2">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-300 font-medium mb-2">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-300 font-medium mb-2">Password (Leave blank to keep unchanged)</label>
                <input type="password" name="password" id="password" minlength="6" maxlength="8" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
            </div>

            <div class="flex gap-4">
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">Update User</button>
            </div>
        </form>
    </div>
</div>
@endsection
