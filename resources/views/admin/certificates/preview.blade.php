<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Certificate – {{ $cert->certificate_number }}</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
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
      <div style="width:96px;height:96px;background:#eab308;border-radius:50%;display:flex;align-items:center;justify-content:center;border:4px solid #ca8a04;box-shadow:0 8px 20px rgba(234,179,8,.3);color:white;font-weight:700;font-size:1.1rem;position:relative;text-align:center;line-height:1.2;">
        <span style="position:absolute;inset:0;border:2px dashed #fde047;border-radius:50%;margin:4px;"></span>
        SD<br>SEAL
      </div>

      {{-- Signature --}}
      <div style="text-align:center;">
        <div style="border-bottom:1px solid #9ca3af;width:192px;padding-bottom:8px;margin-bottom:8px;font-family:'Brush Script MT',cursive;font-size:1.5rem;">
          Admin Director
        </div>
        <p style="font-size:0.75rem;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:0.08em;">Authorized Signature</p>
      </div>
    </div>

  </div>
</div>

</body>
</html>
