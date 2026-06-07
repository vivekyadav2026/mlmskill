@extends('layouts.user')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Allura&family=Cinzel:wght@600;700;800;900&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&family=Montserrat:wght@500;600;700;800&family=Noto+Sans+Devanagari:wght@400;700;900&display=swap');
  .app-main { padding: 20px; }
  .cert-container {
      background: #ffffff;
      border: 4px solid #004d40;
      padding: 6px;
      position: relative;
      width: 100%;
      aspect-ratio: 1.414 / 1;
      color: #0f172a;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
      border-radius: 12px;
      overflow: hidden;
      box-sizing: border-box;
  }
  .cert-inner-border {
      border: 1.5px solid #d4af37;
      height: 100%;
      width: 100%;
      padding: 20px 24px 24px 84px; /* space on left for sidebar */
      position: relative;
      border-radius: 8px;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
  }
  
  @media print {
      @page {
          size: A4 landscape;
          margin: 0;
      }
      body {
          background-color: white !important;
          margin: 0 !important;
          padding: 0 !important;
      }
      .tailwind-scope {
          margin: 0 !important;
          padding: 0 !important;
      }
      body * {
          visibility: hidden;
      }
      #certificate-area, #certificate-area * {
          visibility: visible !important;
      }
      #certificate-area {
          position: absolute;
          left: 0;
          top: 0;
          width: 297mm !important;
          height: 210mm !important;
          margin: 0 !important;
          padding: 0 !important;
          border-radius: 0 !important;
          box-shadow: none !important;
          background: white !important;
      }
      .cert-container {
          width: 297mm !important;
          height: 210mm !important;
          border-width: 5px !important;
          border-radius: 0 !important;
          box-shadow: none !important;
          padding: 8px !important;
          background: white !important;
          -webkit-print-color-adjust: exact;
          print-color-adjust: exact;
      }
      .cert-inner-border {
          padding: 24px 28px 36px 96px !important;
          border-radius: 0 !important;
          border-width: 2px !important;
      }
  }
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
    <div class="max-w-4xl mx-auto mt-6 bg-white p-2 rounded-lg" id="certificate-area" style="-webkit-print-color-adjust: exact; print-color-adjust: exact;">
        <div class="cert-container" style="font-family: 'Inter', sans-serif; border: 5px solid #004d40; padding: 8px; border-radius: 14px; background: #ffffff; position: relative;">
            
            <!-- Diagonal Green & Gold Curved Corner Decorations -->
            <!-- Top Left Diagonal Band -->
            <div class="absolute top-0 left-0 w-44 h-44 overflow-hidden z-0 pointer-events-none">
                <div class="w-[200%] h-[200%] bg-[#004d40] absolute top-0 left-0 transform -rotate-45 origin-top-left -translate-y-[55%] -translate-x-[20%] border-b-8 border-[#d4af37] shadow-lg"></div>
                <!-- Extra fine decorative gold line -->
                <div class="w-[200%] h-[200%] border-t-2 border-[#d4af37]/60 absolute top-[16px] left-[16px] transform -rotate-45 origin-top-left -translate-y-[55%] -translate-x-[20%]"></div>
            </div>
            
            <!-- Bottom Right Diagonal Band -->
            <div class="absolute bottom-0 right-0 w-44 h-44 overflow-hidden z-0 pointer-events-none">
                <div class="w-[200%] h-[200%] bg-[#004d40] absolute bottom-0 right-0 transform -rotate-45 origin-bottom-right translate-y-[55%] translate-x-[20%] border-t-8 border-[#d4af37] shadow-lg"></div>
                <div class="w-[200%] h-[200%] border-b-2 border-[#d4af37]/60 absolute bottom-[16px] right-[16px] transform -rotate-45 origin-bottom-right translate-y-[55%] translate-x-[20%]"></div>
            </div>

            <!-- Subtle Centered Watermark Background (Tree Logo) -->
            <div class="absolute inset-0 flex items-center justify-center opacity-[0.035] pointer-events-none z-0">
                <img src="{{ asset('logo.png') }}" class="w-[320px] h-[320px] object-contain">
            </div>

            <!-- Inner Luxury Gold Border Frame -->
            <div class="cert-inner-border" style="border: 2px solid #d4af37; padding: 14px 18px 24px 84px; border-radius: 10px;">
                
                <!-- Gold Ornamental Corner Flourishes inside the gold border -->
                <svg class="absolute top-1 left-1 w-8 h-8 text-[#d4af37]/70 pointer-events-none" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="3">
                    <path d="M 0,50 L 0,0 L 50,0 M 15,15 L 0,0 M 0,30 L 30,0" />
                </svg>
                <svg class="absolute top-1 right-1 w-8 h-8 text-[#d4af37]/70 pointer-events-none" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="3" style="transform: scaleX(-1);">
                    <path d="M 0,50 L 0,0 L 50,0 M 15,15 L 0,0 M 0,30 L 30,0" />
                </svg>
                <svg class="absolute bottom-6 left-1 w-8 h-8 text-[#d4af37]/70 pointer-events-none" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="3" style="transform: scaleY(-1);">
                    <path d="M 0,50 L 0,0 L 50,0 M 15,15 L 0,0 M 0,30 L 30,0" />
                </svg>
                <svg class="absolute bottom-6 right-1 w-8 h-8 text-[#d4af37]/70 pointer-events-none" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="3" style="transform: scale(-1);">
                    <path d="M 0,50 L 0,0 L 50,0 M 15,15 L 0,0 M 0,30 L 30,0" />
                </svg>

                <!-- Top-Right Certificate Number -->
                <div class="absolute top-4 right-4 text-right z-10 text-[9px] font-bold text-gray-700">
                    <div>Certificate No.:</div>
                    <div class="text-[#004d40] font-mono text-[10px]">{{ $certificate->certificate_number }}</div>
                </div>

                <!-- Left Sidebar Column with Icons -->
                <div class="absolute left-4 top-[15%] bottom-[15%] w-12 flex flex-col items-center justify-around z-10">
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full border-2 border-[#d4af37] bg-white flex items-center justify-center text-[#004d40] shadow-sm">
                            <i class="fa-solid fa-graduation-cap text-base"></i>
                        </div>
                        <span class="text-[7px] font-bold text-[#004d40] uppercase text-center mt-1 leading-tight tracking-wider w-16">Skill<br>Education</span>
                    </div>
                    
                    <div class="w-[1.5px] flex-grow my-1 bg-[#d4af37]"></div>
                    
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full border-2 border-[#d4af37] bg-white flex items-center justify-center text-[#004d40] shadow-sm">
                            <i class="fa-solid fa-desktop text-sm"></i>
                        </div>
                        <span class="text-[7px] font-bold text-[#004d40] uppercase text-center mt-1 leading-tight tracking-wider w-16">Digital<br>Empowerment</span>
                    </div>
                    
                    <div class="w-[1.5px] flex-grow my-1 bg-[#d4af37]"></div>
                    
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full border-2 border-[#d4af37] bg-white flex items-center justify-center text-[#004d40] shadow-sm">
                            <i class="fa-solid fa-briefcase text-sm"></i>
                        </div>
                        <span class="text-[7px] font-bold text-[#004d40] uppercase text-center mt-1 leading-tight tracking-wider w-16">Self<br>Employment</span>
                    </div>
                </div>

                <!-- Center Logo Header & Decorative Gold Flourishes flanking it -->
                <div class="text-center flex flex-col items-center mt-1 relative z-10">
                    <!-- Left logo flourish -->
                    <div class="absolute left-[20%] top-[40px] w-24 h-6 text-[#d4af37]/60 hidden md:block">
                        <svg viewBox="0 0 100 20" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M 0,10 C 30,10 50,5 60,10 C 70,15 80,10 100,10 M 20,5 Q 50,15 80,5" />
                        </svg>
                    </div>
                    
                    <!-- 2x Larger Logo -->
                    <div class="w-24 h-24 rounded-full bg-white border border-gray-100 flex items-center justify-center shadow-md overflow-hidden mb-1 p-0.5">
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="w-full h-full object-contain">
                    </div>
                    
                    <!-- Right logo flourish -->
                    <div class="absolute right-[20%] top-[40px] w-24 h-6 text-[#d4af37]/60 hidden md:block" style="transform: scaleX(-1);">
                        <svg viewBox="0 0 100 20" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M 0,10 C 30,10 50,5 60,10 C 70,15 80,10 100,10 M 20,5 Q 50,15 80,5" />
                        </svg>
                    </div>
                </div>

                <!-- Title Block (40% Larger Heading) -->
                <div class="text-center relative z-10">
                    <h1 class="text-4xl font-extrabold text-[#004d40] tracking-widest leading-none mb-1" style="font-family: 'Cinzel', serif;">CERTIFICATE</h1>
                    <h2 class="text-sm font-bold text-[#aa7c11] tracking-[0.3em] uppercase leading-none" style="font-family: 'Montserrat', sans-serif;">of course completion</h2>
                    
                    <div class="flex items-center justify-center gap-3 my-2">
                        <span class="w-20 h-[1.5px] bg-gradient-to-r from-transparent to-[#aa7c11]"></span>
                        <span class="text-[11px] text-gray-500 italic font-semibold" style="font-family: 'Georgia', serif;">This is to certify that</span>
                        <span class="w-20 h-[1.5px] bg-gradient-to-l from-transparent to-[#aa7c11]"></span>
                    </div>
                </div>

                <!-- Large Student Name Block with Tall Decorative Brackets -->
                <div class="text-center my-1.5 relative z-10">
                    <span class="text-4xl font-extrabold text-[#004d40] tracking-wide block" style="font-family: 'Playfair Display', serif; font-style: italic;">
                        <span class="text-[#aa7c11] font-light text-3xl opacity-80" style="font-family: 'Georgia', serif; vertical-align: middle;">[</span>
                        <span class="mx-4 border-b-2 border-[#d4af37]/50 pb-1 px-8 inline-block min-w-[320px]">{{ $user->name }}</span>
                        <span class="text-[#aa7c11] font-light text-3xl opacity-80" style="font-family: 'Georgia', serif; vertical-align: middle;">]</span>
                    </span>
                </div>

                <!-- Course Details text -->
                <div class="text-center max-w-2xl mx-auto px-4 relative z-10">
                    <p class="text-[9px] text-gray-500 font-bold uppercase tracking-wider mb-1">has successfully completed the course</p>
                    
                    <!-- Course Ribbon Banner (Gold Ribbon Banner instead of button) -->
                    <div class="relative inline-flex items-center justify-center my-2 px-14 py-2 bg-gradient-to-r from-[#d4af37] via-[#f3e5ab] to-[#d4af37] text-[#004d40] font-black text-sm uppercase tracking-widest rounded-sm shadow-md border-y border-[#aa7c11]">
                        <!-- Left banner triangle end overlay -->
                        <span class="absolute left-[-8px] top-0 bottom-0 w-[8px] bg-[#aa7c11] rounded-l-sm"></span>
                        {{ $moduleName }}
                        <!-- Right banner triangle end overlay -->
                        <span class="absolute right-[-8px] top-0 bottom-0 w-[8px] bg-[#aa7c11] rounded-r-sm"></span>
                    </div>

                    <!-- Description -->
                    <p class="text-[10px] text-gray-600 leading-relaxed max-w-xl mx-auto font-medium">
                        with basic computer and AI, manufacturing of cleaning products, gau products and dhoop bati with natural ingredients. This comprehensive course has been designed to provide knowledge and practical skills for self-employment, career growth, and entrepreneurship. We wish the student success in their future endeavors.
                    </p>
                </div>

                <!-- Dates/Grades Row (DomPDF compatible Table structure) -->
                <div class="my-2 relative z-10 text-center">
                    <table style="width: 85%; margin: 0 auto; border: 1.5px solid #d4af37; border-radius: 20px; background: white; padding: 6px 16px; font-size: 9px; font-weight: bold; color: #374151; border-collapse: separate;" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="width: 33%; text-align: center;">
                                <i class="fa-solid fa-calendar" style="color:#004d40; margin-right: 4px;"></i>
                                Course Start Date: <strong style="color:black;">{{ $user->created_at ? $user->created_at->format('d/m/Y') : '01/01/2026' }}</strong>
                            </td>
                            <td style="width: 1px; background: rgba(212,175,55,0.6); height: 16px;"></td>
                            <td style="width: 33%; text-align: center;">
                                <i class="fa-solid fa-star" style="color:#fbbf24; margin-right: 4px;"></i>
                                Grade / Result: <strong style="color:black;">Excellent (A+)</strong>
                            </td>
                            <td style="width: 1px; background: rgba(212,175,55,0.6); height: 16px;"></td>
                            <td style="width: 33%; text-align: center;">
                                <i class="fa-solid fa-circle-check" style="color:#004d40; margin-right: 4px;"></i>
                                Date of Completion: <strong style="color:black;">{{ $certificate->issue_date ? $certificate->issue_date->format('d/m/Y') : now()->format('d/m/Y') }}</strong>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Hindi Slogan Banner -->
                <div class="flex justify-center my-1 relative z-10">
                    <div class="bg-[#004d40] text-[#fbfbfb] px-12 py-1.5 font-bold text-[10px] rounded-full border border-[#d4af37] shadow-sm tracking-wider flex items-center gap-2" style="font-family: 'Noto Sans Devanagari', sans-serif;">
                        कौशल से स्वावलंबन – अब नौकरी नहीं, अपना व्यवसाय करें
                    </div>
                </div>

                <!-- Signatures and Seals Row (DomPDF compatible Table structure) -->
                <div class="relative z-10" style="margin-top: 10px;">
                    <table style="width: 100%; border-collapse: collapse;" cellpadding="0" cellspacing="0">
                        <tr>
                            <!-- Director's Signature (R. K.) -->
                            <td style="width: 30%; text-align: center; vertical-align: bottom;">
                                <div style="height: 44px; display: block; margin-bottom: 4px;">
                                    <!-- Custom drawn elegant R. K. signature -->
                                    <svg viewBox="0 0 200 60" style="width: 110px; height: 38px; fill: none; stroke: #1a365d; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; display: inline-block;">
                                        <path d="M 15,40 C 15,15 30,15 30,22 C 30,30 18,35 25,45 C 30,42 35,32 38,28 M 42,45 A 1,1 0 1 1 42,44.9 M 52,15 L 52,45 M 68,18 C 60,28 53,30 53,30 L 68,45 M 74,45 A 1,1 0 1 1 74,44.9 M 10,48 C 30,50 60,49 85,46" />
                                    </svg>
                                </div>
                                <div style="border-top: 1.5px solid rgba(212,175,55,0.6); width: 85%; margin: 0 auto; padding-top: 2px;">
                                    <p style="font-size: 9px; font-weight: bold; color: #1f2937; margin: 0;">R. K.</p>
                                    <p style="font-size: 6px; font-weight: bold; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Director's Signature</p>
                                </div>
                            </td>

                            <!-- Instructor's Signature (S. Tripathi) -->
                            <td style="width: 30%; text-align: center; vertical-align: bottom;">
                                <div style="height: 44px; display: block; margin-bottom: 4px;">
                                    <!-- Custom drawn S. Tripathi signature -->
                                    <svg viewBox="0 0 200 60" style="width: 110px; height: 38px; fill: none; stroke: #1a365d; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; display: inline-block;">
                                        <path d="M 20,20 C 25,12 35,12 32,22 C 28,32 42,42 50,38 C 58,34 60,15 62,22 C 64,28 58,42 70,36 C 76,32 82,15 85,22 C 88,28 80,42 95,38 C 105,32 110,20 115,28 C 120,35 110,48 130,42 M 25,44 C 55,48 95,44 140,36" />
                                    </svg>
                                </div>
                                <div style="border-top: 1.5px solid rgba(212,175,55,0.6); width: 85%; margin: 0 auto; padding-top: 2px;">
                                    <p style="font-size: 9px; font-weight: bold; color: #1f2937; margin: 0;">S. Tripathi</p>
                                    <p style="font-size: 6px; font-weight: bold; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Instructor's Signature</p>
                                </div>
                            </td>

                            <!-- Premium Embossed Gold Medallion & Seal Section -->
                            <td style="width: 40%; text-align: right; vertical-align: bottom; padding-right: 20px;">
                                <div style="display: inline-block; text-align: center; vertical-align: bottom;">
                                    <!-- Gold Medal with Ribbons -->
                                    <div style="position: relative; width: 88px; height: 88px; display: inline-block; vertical-align: bottom;">
                                        <!-- Green Ribbons -->
                                        <svg style="position: absolute; bottom: -8px; left: 22px; width: 44px; height: 44px; color: #004d40;" viewBox="0 0 100 100" fill="currentColor">
                                            <path d="M 32,20 L 18,90 L 38,80 L 48,90 L 38,20 Z" />
                                            <path d="M 68,20 L 82,90 L 62,80 L 52,90 L 62,20 Z" />
                                        </svg>
                                        <!-- Embossed Gold Badge -->
                                        <svg style="width: 72px; height: 72px; color: #d4af37; position: absolute; top: 0; left: 8px; filter: drop-shadow(0 1px 3px rgba(0,0,0,0.15));" viewBox="0 0 100 100" fill="currentColor">
                                            <circle cx="50" cy="50" r="46" fill="#d4af37" stroke="#aa7c11" stroke-width="2" />
                                            <circle cx="50" cy="50" r="41" fill="none" stroke="#f3e5ab" stroke-width="1.5" stroke-dasharray="3 1.5" />
                                            <circle cx="50" cy="50" r="38" fill="#d4af37" stroke="#aa7c11" stroke-width="1" />
                                            <text x="50" y="46" font-family="'Noto Sans Devanagari', 'Inter', sans-serif" font-size="11" font-weight="900" fill="#004d40" text-anchor="middle">प्रमाणित</text>
                                            <text x="50" y="62" font-family="sans-serif" font-size="12" fill="#004d40" text-anchor="middle">★★★</text>
                                        </svg>
                                    </div>

                                    <!-- Authorized Seal Wreath -->
                                    <div style="display: inline-block; vertical-align: bottom; border-left: 1.5px solid rgba(212,175,55,0.6); padding-left: 8px; margin-left: 8px; height: 50px; width: 64px; text-align: center;">
                                        <svg style="width: 30px; height: 30px; color: #aa7c11; display: block; margin: 0 auto 2px;" viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M 30,65 C 20,50 30,30 50,25 C 70,30 80,50 70,65" />
                                            <path d="M 28,52 Q 22,42 32,42" stroke-width="1.2" />
                                            <path d="M 22,42 Q 16,32 26,32" stroke-width="1.2" />
                                            <path d="M 72,52 Q 78,42 68,42" stroke-width="1.2" />
                                            <path d="M 78,42 Q 84,32 74,32" stroke-width="1.2" />
                                        </svg>
                                        <span style="font-size: 5px; font-weight: bold; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em; line-height: 1.2; display: block;">Authorized<br>Seal</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Green Footer Banner -->
                <div class="w-full bg-[#004d40] text-[#fbfbfb] text-[9px] py-1.5 font-bold flex items-center justify-center gap-1.5 tracking-wider absolute bottom-0 left-0 right-0 rounded-b-[7px]">
                    <i class="fa-solid fa-location-dot text-[#d4af37]"></i>
                    <span>Samarth Skill Development & Employment Program</span>
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
