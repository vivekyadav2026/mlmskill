@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-2xl mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Tokenomics Settings</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6">
        <form onsubmit="event.preventDefault(); alert('Settings Saved!');">
            <div class="mb-4"><label class="block text-gray-300 mb-2">Daily ROI (Utility Tokens)</label><input type="number" step="0.1" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" value="1.5"></div>
            <div class="mb-4"><label class="block text-gray-300 mb-2">Daily ROI (Renewal Tokens)</label><input type="number" step="0.1" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" value="0.5"></div>
            <div class="mb-6"><label class="block text-gray-300 mb-2">Utility to USD Conversion Rate</label><input type="number" step="0.01" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" value="1.00"></div>
            <button class="bg-indigo-600 text-white px-6 py-2 rounded font-bold w-full">Update Global Tokenomics</button>
        </form>
    </div>
</div>
@endsection