<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Certificate – {{ $cert->certificate_number }}</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
  @import url('https://fonts.googleapis.com/css2?family=Allura&display=swap');
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { background: #f1f5f9; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; min-height: 100vh; font-family: 'Outfit', sans-serif; padding: 24px; }

  .actions { display: flex; gap: 10px; margin-bottom: 20px; width: 100%; max-width: 900px; }
  .btn { padding: 8px 20px; border-radius: 8px; font-size: 0.85rem; cursor: pointer; border: none; font-family: inherit; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; }
  .btn-print { background: #4338ca; color: white; }
  .btn-print:hover { background: #3730a3; }
  .btn-back { background: #334155; color: #e2e8f0; }
  .btn-back:hover { background: #475569; }

  /* ── Certificate (mirrors user design exactly) ── */
  #certificate-area { max-width: 900px; width: 100%; background: white; padding: 8px; border-radius: 10px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.3); }

  .cert-container {
      background: url('https://www.transparenttextures.com/patterns/cubes.png'),
                  linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
      border: 8px double #1e293b;
      padding: 40px;
      text-align: center;
      position: relative;
      color: #0f172a;
  }
  .cert-header { font-family: 'Georgia', serif; font-size: 2.5rem; font-weight: bold; color: #1e293b; text-transform: uppercase; letter-spacing: 2px; }
  .cert-name   { font-family: 'Georgia', serif; font-size: 3rem; font-weight: bold; color: #4338ca; margin: 20px 0; border-bottom: 2px solid #cbd5e1; display: inline-block; padding: 0 40px 10px; }
  .cert-number { font-size: 0.75rem; color: #94a3b8; font-family: monospace; margin-top: 16px; letter-spacing: 0.08em; }

  @media print {
    body { background: white; padding: 0; }
    .actions { display: none; }
    #certificate-area { box-shadow: none; padding: 0; }
    .cert-container { border-color: #1e293b; }
  }
</style>
</head>
<body>

<div class="actions">
  <a href="{{ route('admin.certificates.issued') }}" class="btn btn-back"><i class="fa-solid fa-arrow-left"></i> Back to List</a>
  <button class="btn btn-print" onclick="window.print()"><i class="fa-solid fa-print"></i> Print / Save PDF</button>
</div>

<div id="certificate-area">
  <div class="cert-container">

    {{-- Top-left icon --}}
    <div style="position:absolute;top:24px;left:24px;">
      <i class="fa-solid fa-graduation-cap" style="font-size:2.5rem;color:#cbd5e1;"></i>
    </div>

    {{-- Top-right logo --}}
    <div style="position:absolute;top:24px;right:24px;">
      <img src="{{ asset('logo.png') }}" alt="Logo" style="width:64px;height:64px;border-radius:50%;object-fit:cover;box-shadow:0 2px 6px rgba(0,0,0,.15);border:1px solid #e2e8f0;">
    </div>

    <h1 class="cert-header" style="margin-top:40px;">Certificate of Completion</h1>
    <p style="margin-top:32px;font-size:1.25rem;color:#475569;font-style:italic;">This is to proudly certify that</p>

    <h2 class="cert-name">{{ $cert->user->name ?? 'Unknown' }}</h2>

    <p style="margin-top:16px;font-size:1.1rem;color:#475569;max-width:600px;margin-left:auto;margin-right:auto;line-height:1.8;">
      has successfully completed the comprehensive
      <strong style="color:#1e293b;">{{ $cert->module->name ?? ($cert->course->title ?? 'Training Module') }}</strong>
      demonstrating outstanding dedication and skill.
    </p>

    {{-- Footer row --}}
    <div style="margin-top:60px;display:flex;justify-content:space-between;align-items:flex-end;padding:0 48px;">

      {{-- Date --}}
      <div style="text-align:center;">
        <div style="border-bottom:1px solid #9ca3af;width:192px;padding-bottom:8px;margin-bottom:8px;font-weight:500;">
          {{ $cert->issue_date->format('F d, Y') }}
        </div>
        <p style="font-size:0.75rem;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.08em;">Date of Issue</p>
        <p style="font-size:0.65rem;color:#94a3b8;font-family:monospace;margin-top:4px;">{{ $cert->certificate_number }}</p>
      </div>

      {{-- Seal --}}
      <div style="position:relative;display:flex;flex-direction:column;align-items:center;justify-content:center;">
        <!-- Indian Official Seal/Stamp -->
        <div style="position:absolute;top:-45px;user-select:none;opacity:0.9;transform:rotate(-6deg);filter:drop-shadow(0px 4px 10px rgba(0,0,0,0.1));">
          <svg width="105" height="105" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg" style="color: #1e3a8a; fill: none; stroke: currentColor; stroke-linecap: round; stroke-linejoin: round;">
            <circle cx="60" cy="60" r="56" stroke-width="2.2" stroke-dasharray="3 1 1 1" />
            <circle cx="60" cy="60" r="51" stroke-width="0.8" />
            <circle cx="60" cy="60" r="36" stroke-width="1.5" />
            
            <circle cx="60" cy="60" r="16" stroke-width="1.5" />
            <path d="M60,44 L60,76 M44,60 L76,60 M48.7,48.7 L71.3,71.3 M48.7,71.3 L71.3,48.7 M53.8,44.7 L66.2,75.3 M44.7,53.8 L75.3,66.2 M44.7,66.2 L75.3,53.8 M53.8,75.3 L66.2,44.7" stroke-width="0.8" opacity="0.8" />
            
            <path id="preview-stamp-top" d="M 16,60 A 44,44 0 1,1 104,60" fill="none" stroke="none" />
            <path id="preview-stamp-bottom" d="M 104,60 A 44,44 0 1,1 16,60" fill="none" stroke="none" />
            
            <text font-family="'Inter', sans-serif" font-size="7.2" font-weight="900" fill="currentColor" letter-spacing="0.5">
              <textPath href="#preview-stamp-top" startOffset="50%" text-anchor="middle">
                ★ SAMARTH DIGITAL INDIA ★
              </textPath>
            </text>
            <text font-family="'Inter', sans-serif" font-size="6.8" font-weight="900" fill="currentColor" letter-spacing="0.5">
              <textPath href="#preview-stamp-bottom" startOffset="50%" text-anchor="middle">
                GOVERNMENT REGISTERED
              </textPath>
            </text>
          </svg>
        </div>
        <div style="width:96px;height:96px;"></div>
      </div>

      {{-- Signature --}}
      <div style="text-align:center; display:flex; flex-direction:column; align-items:center;">
        <div style="border-bottom:1px solid #9ca3af;width:192px;height:64px;margin-bottom:8px;position:relative;display:flex;align-items:center;justify-content:center;padding-bottom:4px;">
          <!-- Custom Drawn Calligraphy Signature Logo (Offline & 100% Identical) -->
          <svg viewBox="0 0 240 70" style="width:160px;height:64px;fill:none;stroke:#4b5563;stroke-width:2.5;stroke-linecap:round;stroke-linejoin:round;filter:drop-shadow(1px 1px 1px rgba(0,0,0,0.05));">
            <!-- smarth -->
            <path d="M 15,48 C 22,46 26,38 23,45 C 20,52 28,52 35,46 C 38,36 43,36 44,46 C 45,36 49,36 50,46 C 51,36 55,36 56,46 C 58,42 62,38 66,41 C 68,44 67,50 63,49 C 67,46 70,44 71,46 C 73,41 76,40 79,41 C 77,46 76,50 81,46 C 83,36 84,28 85,28 C 85,28 83,41 87,45 C 89,47 93,45 96,44 M 76,35 L 86,35 C 98,32 100,21 100,21 C 100,21 98,36 102,40 C 104,44 107,44 109,44" />
            <!-- space and digital -->
            <path d="M 125,44 C 122,41 125,36 130,37 C 132,40 132,45 128,45 C 128,45 132,28 133,22 C 134,18 133,31 136,44 C 138,39 141,38 143,44 M 139,32 A 1.2,1.2 0 1,1 139,32.1 C 145,40 149,39 150,42 C 151,45 149,48 145,47 C 145,47 149,42 150,44 C 151,47 146,61 141,59 C 138,58 142,50 147,49 C 149,48 153,45 156,44 C 158,39 161,38 163,44 M 159,32 A 1.2,1.2 0 1,1 159,32.1 C 165,36 167,28 167,28 C 167,28 166,41 169,44 M 162,35 L 172,35 C 171,41 175,36 180,38 C 182,41 181,48 177,47 C 181,44 183,42 185,44 C 187,32 190,20 190,20 C 190,20 188,38 192,44 C 194,46 198,44 201,42" />
          </svg>
        </div>
        <p style="font-size:0.75rem;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.08em;">Authorized Signature</p>
      </div>
    </div>

  </div>
</div>

</body>
</html>
