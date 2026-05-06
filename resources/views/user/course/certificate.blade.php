@extends('layouts.user')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<style>
  .app-main { padding: 20px; }
  .cert-container {
      background: url('https://www.transparenttextures.com/patterns/cubes.png'), linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
      border: 8px double #1e293b;
      padding: 40px;
      text-align: center;
      position: relative;
      color: #0f172a;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
  }
  .cert-header { font-family: 'Georgia', serif; font-size: 2.5rem; font-weight: bold; color: #1e293b; text-transform: uppercase; letter-spacing: 2px; }
  .cert-name { font-family: 'Georgia', serif; font-size: 3rem; font-weight: bold; color: #4338ca; margin: 20px 0; border-bottom: 2px solid #cbd5e1; display: inline-block; padding: 0 40px 10px; }
</style>
<div class="tailwind-scope mt-4">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">Your Certificate</h2>
            <p class="text-gray-400">Download and share your official samarth.digital achievement.</p>
        </div>
        <button onclick="window.print()" class="bg-[#1e293b] hover:bg-[#334155] border border-[#475569] text-white px-4 py-2 rounded shadow transition">
            <i class="fa-solid fa-print mr-2"></i> Print / Save PDF
        </button>
    </div>

    @if($user->course_completed_at)
    <div class="max-w-4xl mx-auto mt-8 bg-white p-2 rounded-lg" id="certificate-area">
        <div class="cert-container">
            <div class="absolute top-8 left-8">
                <i class="fa-solid fa-graduation-cap text-4xl text-gray-300"></i>
            </div>
            <div class="absolute top-8 right-8">
                <img src="https://ui-avatars.com/api/?name=SK&background=4338ca&color=fff&rounded=true&size=64" alt="Logo">
            </div>
            
            <h1 class="cert-header mt-10">Certificate of Completion</h1>
            <p class="mt-8 text-xl text-gray-600 italic">This is to proudly certify that</p>
            
            <h2 class="cert-name">{{ $user->name }}</h2>
            
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                has successfully completed the comprehensive <strong class="text-gray-800">SK Global Masterclass</strong> in networking, sales strategy, and system mechanics, demonstrating outstanding dedication and skill.
            </p>
            
            <div class="mt-16 flex justify-between items-end px-12">
                <div class="text-center">
                    <div class="border-b border-gray-400 w-48 pb-2 mb-2 font-medium">{{ \Carbon\Carbon::parse($user->course_completed_at)->format('F d, Y') }}</div>
                    <p class="text-sm font-bold text-gray-500 uppercase">Date of Issue</p>
                </div>
                
                <div class="h-24 w-24 bg-yellow-500 rounded-full flex items-center justify-center border-4 border-yellow-600 shadow-lg text-white font-bold text-xl relative">
                    <span class="absolute inset-0 border-2 border-dashed border-yellow-300 rounded-full m-1"></span>
                    SK<br>SEAL
                </div>

                <div class="text-center">
                    <div class="border-b border-gray-400 w-48 pb-2 mb-2 font-signature text-2xl" style="font-family: 'Brush Script MT', cursive;">Admin Director</div>
                    <p class="text-sm font-bold text-gray-500 uppercase">Authorized Signature</p>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="bg-[#1a222d] border border-red-500/50 p-6 rounded-lg text-center max-w-2xl mx-auto mt-10">
        <i class="fa-solid fa-lock text-4xl text-gray-500 mb-4 block"></i>
        <p class="text-gray-300">You must complete the course before accessing your certificate.</p>
        <a href="{{ url('user/course/progress') }}" class="mt-4 inline-block bg-indigo-600 text-white px-6 py-2 rounded">Go to Course</a>
    </div>
    @endif
</div>
@endsection
