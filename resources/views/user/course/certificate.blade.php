@extends('layouts.user')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Allura&display=swap');
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
        @if($certificate && $certificate->status === 'issued')
        <button onclick="window.print()" class="bg-[#1e293b] hover:bg-[#334155] border border-[#475569] text-white px-4 py-2 rounded shadow transition">
            <i class="fa-solid fa-print mr-2"></i> Print / Save PDF
        </button>
        @endif
    </div>

    @if($certificate && $certificate->status === 'issued')
    <div class="max-w-4xl mx-auto mt-8 bg-white p-2 rounded-lg" id="certificate-area">
        <div class="cert-container">
            <div class="absolute top-8 left-8">
                <i class="fa-solid fa-graduation-cap text-4xl text-gray-300"></i>
            </div>
            <div class="absolute top-8 right-8">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="w-16 h-16 rounded-full object-cover shadow-sm border border-gray-200">
            </div>
            
            <h1 class="cert-header mt-10">Certificate of Completion</h1>
            <p class="mt-8 text-xl text-gray-600 italic">This is to proudly certify that</p>
            
            <h2 class="cert-name">{{ $user->name }}</h2>
            
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                has successfully completed the comprehensive <strong class="text-gray-800">{{ $moduleName }}</strong> covering {{ $moduleDesc }}, demonstrating outstanding dedication and skill.
            </p>
            
            <div class="mt-16 flex justify-between items-end px-12">
                <div class="text-center">
                    <div class="border-b border-gray-400 w-48 pb-2 mb-2 font-medium">{{ $certificate->issue_date ? $certificate->issue_date->format('F d, Y') : now()->format('F d, Y') }}</div>
                    <p class="text-sm font-bold text-gray-500 uppercase">Date of Issue</p>
                </div>
                
                <div class="relative flex flex-col items-center justify-center">
                    <!-- Indian Official Seal/Stamp -->
                    <div class="absolute -top-12 select-none opacity-90 transform -rotate-6 transition hover:rotate-0" style="filter: drop-shadow(0px 4px 10px rgba(0,0,0,0.1));">
                        <svg width="105" height="105" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg" style="color: #1e3a8a; fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round;">
                            <!-- Outer double rings with subtle dash for stamp feel -->
                            <circle cx="60" cy="60" r="56" stroke-width="2.2" stroke-dasharray="3 1 1 1" />
                            <circle cx="60" cy="60" r="51" stroke-width="0.8" />
                            <circle cx="60" cy="60" r="36" stroke-width="1.5" />
                            
                            <!-- Spokes/Center Emblem (Ashoka Chakra design) -->
                            <circle cx="60" cy="60" r="16" stroke-width="1.5" />
                            <!-- 24 spikes in Chakra (simplified for clarity but accurate looking) -->
                            <path d="M60,44 L60,76 M44,60 L76,60 M48.7,48.7 L71.3,71.3 M48.7,71.3 L71.3,48.7 M53.8,44.7 L66.2,75.3 M44.7,53.8 L75.3,66.2 M44.7,66.2 L75.3,53.8 M53.8,75.3 L66.2,44.7" stroke-width="0.8" opacity="0.8" />
                            
                            <!-- Circular Paths for Text -->
                            <path id="cert-stamp-top" d="M 16,60 A 44,44 0 1,1 104,60" fill="none" stroke="none" />
                            <path id="cert-stamp-bottom" d="M 104,60 A 44,44 0 1,1 16,60" fill="none" stroke="none" />
                            
                            <text font-family="'Inter', sans-serif" font-size="7.2" font-weight="900" fill="currentColor" letter-spacing="0.5">
                                <textPath href="#cert-stamp-top" startOffset="50%" text-anchor="middle">
                                    ★ SAMARTH DIGITAL INDIA ★
                                </textPath>
                            </text>
                            <text font-family="'Inter', sans-serif" font-size="6.8" font-weight="900" fill="currentColor" letter-spacing="0.5">
                                <textPath href="#cert-stamp-bottom" startOffset="50%" text-anchor="middle">
                                    GOVERNMENT REGISTERED
                                </textPath>
                            </text>
                        </svg>
                    </div>
                    <!-- Small placeholder underneath to maintain spacing -->
                    <div class="h-24 w-24"></div>
                </div>

                <div class="text-center flex flex-col items-center">
                    <div class="w-48 h-16 flex items-center justify-center mb-2 relative border-b border-gray-400 pb-1">
                        <!-- Custom Drawn Calligraphy Signature Logo (Offline & 100% Identical) -->
                        <svg viewBox="0 0 240 70" class="w-44 h-16" style="fill: none; stroke: #4b5563; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; filter: drop-shadow(1px 1px 1px rgba(0,0,0,0.05));">
                            <!-- smarth -->
                            <path d="M 15,48 C 22,46 26,38 23,45 C 20,52 28,52 35,46 C 38,36 43,36 44,46 C 45,36 49,36 50,46 C 51,36 55,36 56,46 C 58,42 62,38 66,41 C 68,44 67,50 63,49 C 67,46 70,44 71,46 C 73,41 76,40 79,41 C 77,46 76,50 81,46 C 83,36 84,28 85,28 C 85,28 83,41 87,45 C 89,47 93,45 96,44 M 76,35 L 86,35 C 98,32 100,21 100,21 C 100,21 98,36 102,40 C 104,44 107,44 109,44" />
                            <!-- space and digital -->
                            <path d="M 125,44 C 122,41 125,36 130,37 C 132,40 132,45 128,45 C 128,45 132,28 133,22 C 134,18 133,31 136,44 C 138,39 141,38 143,44 M 139,32 A 1.2,1.2 0 1,1 139,32.1 C 145,40 149,39 150,42 C 151,45 149,48 145,47 C 145,47 149,42 150,44 C 151,47 146,61 141,59 C 138,58 142,50 147,49 C 149,48 153,45 156,44 C 158,39 161,38 163,44 M 159,32 A 1.2,1.2 0 1,1 159,32.1 C 165,36 167,28 167,28 C 167,28 166,41 169,44 M 162,35 L 172,35 C 171,41 175,36 180,38 C 182,41 181,48 177,47 C 181,44 183,42 185,44 C 187,32 190,20 190,20 C 190,20 188,38 192,44 C 194,46 198,44 201,42" />
                        </svg>
                    </div>
                    <p class="text-sm font-bold text-gray-500 uppercase">Authorized Signature</p>
                </div>
            </div>
        </div>
    </div>
    @elseif($certificate && $certificate->status === 'pending')
    <div class="bg-[#1a222d] border border-yellow-500/50 p-10 rounded-lg text-center max-w-2xl mx-auto mt-10 shadow-lg">
        <i class="fa-solid fa-hourglass-half text-5xl text-yellow-400 mb-5 block animate-pulse"></i>
        <h3 class="text-2xl font-bold text-white mb-2">Awaiting Admin Approval</h3>
        <p class="text-gray-300 mb-6 leading-relaxed">
            Your course completion status is under review. Your official certificate (and Nexa 3.0 Token rewards) will be unlocked as soon as an administrator approves your request.
        </p>
        <div class="inline-block bg-[#0f172a] border border-[#334155] rounded-lg px-5 py-3 text-xs text-left">
            <span class="text-gray-500">Request Date:</span> 
            <span class="text-gray-300 font-semibold">{{ $certificate->created_at->format('d M Y, h:i A') }}</span>
        </div>
        <a href="{{ url('user/course/complete') }}" class="mt-6 block text-indigo-400 hover:text-indigo-300 text-sm transition">
            <i class="fa-solid fa-arrow-left mr-1"></i> Back to Completion Status
        </a>
    </div>
    @else
    <div class="bg-[#1a222d] border border-red-500/50 p-6 rounded-lg text-center max-w-2xl mx-auto mt-10">
        <i class="fa-solid fa-lock text-4xl text-gray-500 mb-4 block"></i>
        <p class="text-gray-300">You must complete the course and obtain admin approval before accessing your certificate.</p>
        <a href="{{ url('user/course/complete') }}" class="mt-4 inline-block bg-indigo-600 text-white px-6 py-2 rounded">Check Progress</a>
    </div>
    @endif
</div>
@endsection
