@extends('layouts.admin')

@section('content')
<div class="tailwind-scope mt-4 max-w-2xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-100">Generate Certificate</h2>
        <a href="{{ route('admin.certificates.issued') }}" class="px-4 py-2 bg-[#334155] hover:bg-[#475569] text-white rounded shadow transition">View Issued Certificates</a>
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

    @if (session('error'))
    <div class="bg-red-900 border-l-4 border-red-500 text-red-200 p-4 mb-6">
        {{ session('error') }}
    </div>
    @endif

    @if (session('success'))
    <div class="bg-green-900 border-l-4 border-green-500 text-green-200 p-4 mb-6">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6 shadow-xl">
        <form action="{{ route('admin.certificates.generate') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="user_id" class="block text-gray-300 font-medium mb-2">Select User</label>
                <select name="user_id" id="user_id" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" required>
                    <option value="" disabled selected>-- Select a User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label for="course_id" class="block text-gray-300 font-medium mb-2">Select Course</label>
                <select name="course_id" id="course_id" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" required>
                    <option value="" disabled selected>-- Select a Course --</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-2"><i class="fa-solid fa-info-circle"></i> Make sure the user has actually completed this course before generating.</p>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="w-full px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-lg transition">
                    <i class="fa-solid fa-certificate mr-2"></i> Generate & Issue Certificate
                </button>
            </div>
        </form>
    </div>
</div>
@endsection