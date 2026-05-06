@extends('layouts.user')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Course Completion</h2>
        <p class="text-gray-400">Finish your final assessment to receive your certification.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-[#334155] max-w-2xl mx-auto p-10 text-center">
        @if(!$user->course_completed_at)
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-indigo-500/20 text-indigo-400 mb-6">
                <i class="fa-solid fa-list-check text-5xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-white mb-4">Ready to Complete?</h3>
            <p class="text-gray-400 mb-8">By clicking the button below, you confirm that you have watched all training modules and understand the platform mechanics.</p>
            
            <form action="{{ route('course.complete') }}" method="POST">
                @csrf
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded shadow-lg transition text-lg w-full">
                    <i class="fa-solid fa-check-double mr-2"></i> Mark Course as Completed
                </button>
            </form>
        @else
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-green-500/20 text-green-400 mb-6 border border-green-500/50 shadow-[0_0_15px_rgba(34,197,94,0.3)]">
                <i class="fa-solid fa-check text-5xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-white mb-2">Congratulations!</h3>
            <p class="text-gray-400 mb-6">You successfully completed the SK Global Masterclass on {{ \Carbon\Carbon::parse($user->course_completed_at)->format('F d, Y') }}.</p>
            
            <a href="{{ url('user/course/certificate') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded shadow transition block mx-auto max-w-xs">
                <i class="fa-solid fa-certificate mr-2"></i> View Certificate
            </a>
        @endif
    </div>
</div>
@endsection
