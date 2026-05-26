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
    @if(session('error'))
        <div class="bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-[#334155] max-w-2xl mx-auto p-10 text-center">
        @if(!$user->course_completed_at)
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-indigo-500/20 text-indigo-400 mb-6">
                <i class="fa-solid fa-list-check text-5xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-white mb-4">Ready to Complete?</h3>
            <p class="text-gray-400 mb-6">By clicking the button below, you confirm that you have watched all training modules and understand the platform mechanics.</p>
            
            <div class="bg-[#0f172a] rounded-lg p-5 border border-amber-500/30 text-left mb-6">
                <h4 class="text-amber-400 font-bold text-sm mb-2"><i class="fa-solid fa-clock mr-1"></i> Course Completion Validity Rule</h4>
                <p class="text-xs text-gray-400 leading-relaxed">
                    Under the <strong>1-Year Course Completion Validity Rule</strong>, you can only finalize your course and request a certificate after 1 year (365 days) from your account activation date.
                </p>
                <div class="mt-3 text-xs">
                    <span class="text-gray-500">Your Activation Date:</span> 
                    <span class="text-gray-300 font-semibold">{{ $user->activation_date ? $user->activation_date->format('d M, Y') : 'Not Activated' }}</span>
                </div>
            </div>

            @if($canComplete)
                <form action="{{ route('course.complete') }}" method="POST" onsubmit="return confirm('⚠️ Warning: Are you sure you have completed your course? Once you proceed, admin approval will be required to issue your certificate.');">
                    @csrf
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded shadow-lg transition text-lg w-full">
                        <i class="fa-solid fa-check-double mr-2"></i> Mark Course as Completed
                    </button>
                </form>
            @else
                <button type="button" disabled class="bg-gray-700 text-gray-500 font-bold py-3 px-8 rounded shadow-lg text-lg w-full cursor-not-allowed">
                    <i class="fa-solid fa-lock mr-2"></i> Locked ({{ $daysRemaining }} days remaining)
                </button>
                <p class="text-xs text-red-400 mt-2"><i class="fa-solid fa-circle-exclamation mr-1"></i> You must complete 1 year of enrollment before finalizing this course.</p>
            @endif
        @else
            @if($pendingCertificate)
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-yellow-500/20 text-yellow-400 mb-6 border border-yellow-500/50 shadow-[0_0_15px_rgba(234,179,8,0.3)]">
                    <i class="fa-solid fa-hourglass-half text-5xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-2">Pending Admin Approval</h3>
                <p class="text-gray-400 mb-6 max-w-md mx-auto">
                    You completed the course on {{ \Carbon\Carbon::parse($user->course_completed_at)->format('F d, Y') }}. Your certificate and Nexa 3.0 tokens are awaiting admin verification.
                </p>
                <a href="{{ url('user/course/certificate') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded shadow transition block mx-auto max-w-xs">
                    <i class="fa-solid fa-certificate mr-2"></i> Check Status
                </a>
            @else
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-green-500/20 text-green-400 mb-6 border border-green-500/50 shadow-[0_0_15px_rgba(34,197,94,0.3)]">
                    <i class="fa-solid fa-check text-5xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-2">Congratulations!</h3>
                <p class="text-gray-400 mb-6">You successfully completed the {{ $moduleName }} on {{ \Carbon\Carbon::parse($user->course_completed_at)->format('F d, Y') }}.</p>
                
                <a href="{{ url('user/course/certificate') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded shadow transition block mx-auto max-w-xs">
                    <i class="fa-solid fa-certificate mr-2"></i> View Certificate
                </a>
            @endif
        @endif
    </div>
</div>
@endsection
