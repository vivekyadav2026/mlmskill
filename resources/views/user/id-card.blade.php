@extends('layouts.user')

@section('content')
<div class="tailwind-scope mt-4 max-w-4xl mx-auto">
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-100"><i class="fa-solid fa-id-badge mr-2 text-indigo-500"></i>Digital ID Card</h2>
            <p class="text-gray-400">Your official representative identity card.</p>
        </div>
        <button onclick="window.print()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg font-bold shadow-lg flex items-center gap-2 transition transform hover:-translate-y-0.5 print:hidden">
            <i class="fa-solid fa-print"></i> Print ID Card
        </button>
    </div>

    <!-- ID Card Container -->
    <div class="flex justify-center my-12 id-card-wrapper">
        
        <!-- The Card -->
        <div class="w-[320px] h-[520px] bg-white rounded-[24px] overflow-hidden shadow-2xl relative border border-gray-200 id-card-design font-sans" style="font-family: 'Inter', sans-serif; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
            
            <!-- Background Subtle Geometric Pattern -->
            <div class="absolute inset-0 opacity-[0.03] z-0" style="background-image: linear-gradient(30deg, #4f46e5 12%, transparent 12.5%, transparent 87%, #4f46e5 87.5%, #4f46e5), linear-gradient(150deg, #4f46e5 12%, transparent 12.5%, transparent 87%, #4f46e5 87.5%, #4f46e5), linear-gradient(30deg, #4f46e5 12%, transparent 12.5%, transparent 87%, #4f46e5 87.5%, #4f46e5), linear-gradient(150deg, #4f46e5 12%, transparent 12.5%, transparent 87%, #4f46e5 87.5%, #4f46e5), linear-gradient(60deg, #4f46e577 25%, transparent 25.5%, transparent 75%, #4f46e577 75%, #4f46e577), linear-gradient(60deg, #4f46e577 25%, transparent 25.5%, transparent 75%, #4f46e577 75%, #4f46e577); background-size: 80px 140px; background-position: 0 0, 0 0, 40px 70px, 40px 70px, 0 0, 40px 70px;"></div>

            <!-- Left Abstract Shapes -->
            <div class="absolute top-0 left-0 w-24 h-full z-0 overflow-hidden pointer-events-none">
                <div class="absolute -top-10 -left-6 w-20 h-[50%] bg-[#3b41c5] rounded-full"></div>
                <div class="absolute -top-16 left-6 w-16 h-[40%] bg-[#939cf5] rounded-full opacity-80"></div>
                <svg class="absolute top-0 left-0 w-48 h-48 text-[#3b41c5]" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                  <path fill="currentColor" d="M38.1,-63.3C49.5,-55.8,59,-44.6,66.3,-31.8C73.6,-19,78.6,-4.5,75.4,8.1C72.1,20.6,60.6,31.2,49.8,41.4C39,51.6,28.8,61.4,15.6,66.4C2.4,71.4,-13.7,71.7,-28.4,66.7C-43.1,61.7,-56.3,51.4,-64.7,38.2C-73.1,25,-76.6,8.9,-72.5,-5.2C-68.5,-19.3,-56.9,-31.4,-45.3,-39.8C-33.8,-48.1,-22.3,-52.7,-10.1,-55.8C2.1,-58.9,14.3,-60.5,26.7,-70.8L38.1,-63.3Z" transform="translate(0 0) scale(1.1)" />
                </svg>
            </div>

            <!-- Right Bottom Abstract Shapes -->
            <div class="absolute bottom-0 right-0 w-full h-32 z-0 overflow-hidden pointer-events-none">
                <div class="absolute -bottom-10 -right-10 w-full h-full bg-[#3b41c5] rounded-t-full transform rotate-12"></div>
                <div class="absolute -bottom-16 right-10 w-[80%] h-full bg-[#2a2e99] rounded-t-[100px] transform -rotate-6 opacity-90"></div>
                <div class="absolute bottom-10 -right-10 w-32 h-32 bg-[#939cf5] rounded-full opacity-90"></div>
            </div>

            <!-- Top Right Company Logo -->
            <div class="absolute top-6 right-6 z-10 flex items-center gap-2">
                <span class="font-bold text-[#1e2380] uppercase tracking-wider text-[11px]">Samarth Digital</span>
                <img src="{{ asset('logo.png') }}" alt="Logo" class="w-6 h-6 rounded-full object-cover shadow-sm">
            </div>

            <!-- Profile Content -->
            <div class="relative z-10 flex flex-col items-center pt-20 h-full w-full">
                
                <!-- Profile Image -->
                <div class="w-[120px] h-[120px] rounded-full border-[6px] border-white shadow-sm bg-gray-100 overflow-hidden mb-4">
                    @if($user->profile_image)
                        <img src="{{ asset($user->profile_image) }}" alt="Photo" class="w-full h-full object-cover">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=3b41c5&color=fff&size=256" alt="Photo" class="w-full h-full object-cover">
                    @endif
                </div>

                <!-- Name & Role -->
                <h2 class="text-[20px] font-black text-[#1e2380] uppercase tracking-wide mb-0.5 leading-tight">{{ $user->name }}</h2>
                <p class="text-[#3b41c5] text-[13px] font-medium tracking-wide mb-3"></p>

                <!-- Details List -->
                <div class="w-full px-10 relative z-20 bg-white/40 backdrop-blur-[2px] rounded-lg">
                    <table class="w-full text-left text-[11px]">
                        <tbody>
                            <tr>
                                <td class="font-bold text-[#1e2380] py-1 w-16">ID No</td>
                                <td class="text-[#3b41c5] py-1 pl-2 font-medium"><span class="mr-2 text-[#1e2380]">:</span> {{ $user->referral_code }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold text-[#1e2380] py-1">Email</td>
                                <td class="text-[#3b41c5] py-1 pl-2 font-medium"><span class="mr-2 text-[#1e2380]">:</span> {{ Str::limit($user->email, 22) }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold text-[#1e2380] py-1">Phone</td>
                                <td class="text-[#3b41c5] py-1 pl-2 font-medium"><span class="mr-2 text-[#1e2380]">:</span> {{ $user->phone ?? 'Not Provided' }}</td>
                            </tr>
                            <tr>
                                <td class="font-bold text-[#1e2380] py-1">Package</td>
                                <td class="text-[#3b41c5] py-1 pl-2 font-bold"><span class="mr-2 text-[#1e2380] font-medium">:</span> 
                                    @if($user->status === 'active')
                                        NGO Sponsored - {{ $moduleName ?? 'Foundation Course' }}
                                    @else
                                        Not Enrolled
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Stamp & Signature Block -->
                <div class="w-full px-10 mt-3 flex justify-between items-center relative z-20">
                    <!-- ID Stamp -->
                    <div class="relative select-none opacity-80 transform -rotate-12 hover:rotate-0 transition-transform duration-200" style="filter: drop-shadow(1px 2px 4px rgba(0,0,0,0.08));">
                        <svg width="52" height="52" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg" style="color: #1e3a8a; fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round;">
                            <circle cx="60" cy="60" r="56" stroke-width="2.5" stroke-dasharray="3 1 1 1" />
                            <circle cx="60" cy="60" r="51" stroke-width="1" />
                            <circle cx="60" cy="60" r="36" stroke-width="1.5" />
                            
                            <circle cx="60" cy="60" r="16" stroke-width="1.5" />
                            <!-- Ashoka Chakra Spokes -->
                            <path d="M60,44 L60,76 M44,60 L76,60 M48.7,48.7 L71.3,71.3 M48.7,71.3 L71.3,48.7" stroke-width="1.2" />
                            
                            <path id="card-stamp-top" d="M 16,60 A 44,44 0 1,1 104,60" fill="none" stroke="none" />
                            <path id="card-stamp-bottom" d="M 104,60 A 44,44 0 1,1 16,60" fill="none" stroke="none" />
                            
                            <text font-family="'Inter', sans-serif" font-size="7.5" font-weight="900" fill="currentColor" letter-spacing="0.5">
                                <textPath href="#card-stamp-top" startOffset="50%" text-anchor="middle">
                                    SAMARTH DIGITAL
                                </textPath>
                            </text>
                            <text font-family="'Inter', sans-serif" font-size="7" font-weight="900" fill="currentColor" letter-spacing="0.5">
                                <textPath href="#card-stamp-bottom" startOffset="50%" text-anchor="middle">
                                    ★ OFFICIAL SEAL ★
                                </textPath>
                            </text>
                        </svg>
                    </div>

                    <!-- ID Signature -->
                    <div class="text-right flex flex-col items-end">
                        <div class="h-8 w-24 relative flex items-center justify-end pb-0.5">
                            <!-- Custom Drawn Calligraphy Signature Logo (Offline & 100% Identical) -->
                            <svg viewBox="0 0 240 70" class="w-20 h-8" style="fill: none; stroke: #4b5563; stroke-width: 3.0; stroke-linecap: round; stroke-linejoin: round; filter: drop-shadow(1px 1px 1px rgba(0,0,0,0.05));">
                                <!-- smarth -->
                                <path d="M 15,48 C 22,46 26,38 23,45 C 20,52 28,52 35,46 C 38,36 43,36 44,46 C 45,36 49,36 50,46 C 51,36 55,36 56,46 C 58,42 62,38 66,41 C 68,44 67,50 63,49 C 67,46 70,44 71,46 C 73,41 76,40 79,41 C 77,46 76,50 81,46 C 83,36 84,28 85,28 C 85,28 83,41 87,45 C 89,47 93,45 96,44 M 76,35 L 86,35 C 98,32 100,21 100,21 C 100,21 98,36 102,40 C 104,44 107,44 109,44" />
                                <!-- space and digital -->
                                <path d="M 125,44 C 122,41 125,36 130,37 C 132,40 132,45 128,45 C 128,45 132,28 133,22 C 134,18 133,31 136,44 C 138,39 141,38 143,44 M 139,32 A 1.2,1.2 0 1,1 139,32.1 C 145,40 149,39 150,42 C 151,45 149,48 145,47 C 145,47 149,42 150,44 C 151,47 146,61 141,59 C 138,58 142,50 147,49 C 149,48 153,45 156,44 C 158,39 161,38 163,44 M 159,32 A 1.2,1.2 0 1,1 159,32.1 C 165,36 167,28 167,28 C 167,28 166,41 169,44 M 162,35 L 172,35 C 171,41 175,36 180,38 C 182,41 181,48 177,47 C 181,44 183,42 185,44 C 187,32 190,20 190,20 C 190,20 188,38 192,44 C 194,46 198,44 201,42" />
                            </svg>
                        </div>
                        <div class="border-t border-[#1e2380]/40 w-24 mt-1"></div>
                        <span class="text-[8px] font-bold text-[#1e2380] uppercase tracking-wider mt-0.5">Authorized Sign</span>
                    </div>
                </div>

                <!-- Barcode Placeholder -->
                <div class="mt-4 mb-2 px-12 w-full flex justify-center relative z-20">
                    <img src="https://barcode.tec-it.com/barcode.ashx?data={{ urlencode($user->referral_code) }}&code=Code128&translate-esc=on&hidehrt=True" alt="Barcode" class="h-10 mix-blend-multiply opacity-80 w-full object-fill bg-white px-2 py-1 rounded">
                </div>

                <!-- Website URL -->
                <div class="absolute bottom-4 w-full text-center z-20">
                    <p class="text-white drop-shadow-md text-[10px] font-medium tracking-wide">www.samarth.digital</p>
                </div>
            </div>

        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Allura&display=swap');
        @media print {
            @page {
                size: 320px 520px; /* Exactly matches the ID card width and height */
                margin: 0;
            }
            body {
                margin: 0;
                padding: 0;
                background-color: white !important;
            }
            
            /* Hide EVERYTHING by default during print */
            body * {
                visibility: hidden;
            }
            
            /* Show ONLY the ID card container and its children */
            .id-card-wrapper, .id-card-wrapper * {
                visibility: visible !important;
            }
            
            /* Position the ID card exactly at the top-left of the custom page size */
            .id-card-wrapper {
                position: absolute;
                left: 0;
                top: 0;
                margin: 0 !important;
                padding: 0 !important;
                display: block !important;
            }
            
            .id-card-design {
                box-shadow: none !important;
                border: none !important;
                border-radius: 0 !important; /* Remove rounded corners for physical printing */
                margin: 0 !important;
                transform: none !important; /* Remove any scaling */
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            
            /* Explicitly hide the sidebar and topbar which might interfere */
            .app-sidebar, .app-topbar, .app-header {
                display: none !important;
                height: 0 !important;
                width: 0 !important;
                overflow: hidden !important;
            }
        }
    </style>
</div>
@endsection
