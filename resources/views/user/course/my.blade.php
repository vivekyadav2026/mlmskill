@extends('layouts.user')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">My Course Overview</h2>
        <p class="text-gray-400">Access your purchased skill development packages and video modules here.</p>
    </div>

    @if($user->status === 'active')
    <div class="bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-green-500/50 mb-8 max-w-4xl">
        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/3 bg-gray-900 border-r border-[#334155] p-6 flex items-center justify-center">
                <i class="fa-solid fa-graduation-cap text-8xl text-indigo-500"></i>
            </div>
            <div class="p-8 md:w-2/3">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <span class="bg-green-900 text-green-300 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Active Enrollment</span>
                        <h3 class="text-2xl font-bold text-white mt-2">SK Global Masterclass ($300)</h3>
                    </div>
                </div>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    Welcome to the masterclass! This course includes comprehensive training on multi-level networking, direct sales strategies, and wealth accumulation systems.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ url('user/course/progress') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded shadow transition">
                        <i class="fa-solid fa-play mr-2"></i> Start Learning
                    </a>
                    @if($user->course_completed_at)
                    <a href="{{ url('user/course/certificate') }}" class="bg-[#0b1220] hover:bg-gray-800 border border-[#334155] text-white px-6 py-2 rounded shadow transition">
                        <i class="fa-solid fa-award mr-2 text-yellow-500"></i> Get Certificate
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl">
        <div class="bg-[#1a222d] border border-[#334155] p-5 rounded-lg flex items-center">
            <div class="h-12 w-12 rounded-full bg-blue-500/20 text-blue-400 flex items-center justify-center text-xl mr-4"><i class="fa-solid fa-video"></i></div>
            <div><h4 class="text-white font-medium">12 Video Modules</h4><p class="text-xs text-gray-500">High-definition training</p></div>
        </div>
        <div class="bg-[#1a222d] border border-[#334155] p-5 rounded-lg flex items-center">
            <div class="h-12 w-12 rounded-full bg-orange-500/20 text-orange-400 flex items-center justify-center text-xl mr-4"><i class="fa-solid fa-file-pdf"></i></div>
            <div><h4 class="text-white font-medium">Downloadable Resources</h4><p class="text-xs text-gray-500">Workbooks & PDFs</p></div>
        </div>
        <div class="bg-[#1a222d] border border-[#334155] p-5 rounded-lg flex items-center">
            <div class="h-12 w-12 rounded-full bg-yellow-500/20 text-yellow-400 flex items-center justify-center text-xl mr-4"><i class="fa-solid fa-certificate"></i></div>
            <div><h4 class="text-white font-medium">Official Certification</h4><p class="text-xs text-gray-500">Upon completion</p></div>
        </div>
    </div>

    @else
    <div class="bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-red-500/50 p-10 text-center max-w-3xl">
        <i class="fa-solid fa-lock text-6xl text-gray-600 mb-6 block"></i>
        <h3 class="text-2xl font-bold text-gray-200 mb-2">Course Locked</h3>
        <p class="text-gray-400 mb-8 max-w-lg mx-auto">You have not purchased the $300 course package yet. Please upgrade your package to activate your account and unlock the training materials.</p>
        <a href="{{ url('user/package/upgrade') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded shadow transition text-lg">
            Unlock Course Now
        </a>
    </div>
    @endif
</div>
@endsection
