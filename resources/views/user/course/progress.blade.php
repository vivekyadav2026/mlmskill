@extends('layouts.user')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4">
    <div class="mb-6 flex justify-between items-end">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">Course Progress</h2>
            <p class="text-gray-400">Watch the modules to complete your training.</p>
        </div>
        @if($user->status === 'active')
        <div class="text-right">
            <p class="text-sm text-gray-400 mb-1">Overall Completion</p>
            <div class="w-48 bg-gray-900 rounded-full h-2.5 border border-[#334155]">
                <div class="bg-indigo-500 h-2.5 rounded-full" style="width: {{ $user->course_completed_at ? '100%' : '50%' }}"></div>
            </div>
            <p class="text-xs text-indigo-400 mt-1 font-bold">{{ $user->course_completed_at ? '100%' : '50%' }}</p>
        </div>
        @endif
    </div>

    @if($user->status === 'active')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <!-- Video Player Placeholder -->
            <div class="bg-black rounded-lg border border-[#334155] aspect-video flex items-center justify-center relative overflow-hidden shadow-2xl mb-4">
                <i class="fa-solid fa-circle-play text-7xl text-white/50 hover:text-white cursor-pointer transition"></i>
                <div class="absolute bottom-4 left-4 text-white font-medium bg-black/50 px-3 py-1 rounded">Module 1: Introduction to Network Marketing</div>
            </div>
            
            <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6">
                <h3 class="text-xl font-bold text-white mb-2">Module 1 Description</h3>
                <p class="text-gray-400">In this foundational lesson, you will learn the exact strategies top earners use to build their initial network and create daily momentum.</p>
            </div>
        </div>
        
        <div>
            <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
                <div class="px-5 py-4 border-b border-[#334155] bg-[#0f172a]">
                    <h3 class="font-bold text-gray-200">Course Chapters</h3>
                </div>
                <div class="divide-y divide-[#334155] max-h-[600px] overflow-y-auto">
                    <!-- Lesson Items -->
                    <div class="p-4 bg-indigo-900/20 border-l-4 border-indigo-500 cursor-pointer">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="text-white font-medium text-sm">1. Introduction to Network Marketing</h4>
                                <p class="text-xs text-gray-500 mt-1">12:45 <i class="fa-solid fa-play ml-2 text-indigo-400"></i> Playing</p>
                            </div>
                            <i class="fa-solid fa-circle-check text-green-500"></i>
                        </div>
                    </div>
                    <div class="p-4 hover:bg-[#1e293b] cursor-pointer transition">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="text-gray-300 font-medium text-sm">2. Mastering the Invite</h4>
                                <p class="text-xs text-gray-500 mt-1">18:20</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 hover:bg-[#1e293b] cursor-pointer transition">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="text-gray-300 font-medium text-sm">3. Understanding Tokenomics</h4>
                                <p class="text-xs text-gray-500 mt-1">22:15</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 opacity-50 cursor-not-allowed">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="text-gray-400 font-medium text-sm">4. Advanced Team Building</h4>
                                <p class="text-xs text-gray-500 mt-1"><i class="fa-solid fa-lock mr-1"></i> Locked</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <a href="{{ url('user/course/complete') }}" class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded shadow transition">
                    Finish Course & Take Exam
                </a>
            </div>
        </div>
    </div>
    @else
    <div class="bg-[#1a222d] border border-red-500/50 p-6 rounded-lg">
        <p class="text-red-400"><i class="fa-solid fa-triangle-exclamation mr-2"></i> You must be an active member to view course progress.</p>
    </div>
    @endif
</div>
@endsection
