@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-3xl mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Commission Structure Settings</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6">
        <h3 class="text-white font-bold mb-4">Direct Referral Income</h3>
        <div class="mb-6"><label class="block text-gray-300 mb-2">Reward Amount ($)</label><input type="number" value="5.00" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded"></div>
        
        <h3 class="text-white font-bold mb-4 border-t border-[#334155] pt-4">Generation (Level) Income</h3>
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div><label class="block text-gray-300 mb-2">Level 1 ($)</label><input type="number" value="2.00" class="w-full bg-[#0b1220] border border-[#334155] text-white p-2 rounded"></div>
            <div><label class="block text-gray-300 mb-2">Level 2 ($)</label><input type="number" value="1.00" class="w-full bg-[#0b1220] border border-[#334155] text-white p-2 rounded"></div>
            <div><label class="block text-gray-300 mb-2">Level 3 ($)</label><input type="number" value="0.50" class="w-full bg-[#0b1220] border border-[#334155] text-white p-2 rounded"></div>
            <div><label class="block text-gray-300 mb-2">Level 4-10 ($)</label><input type="number" value="0.25" class="w-full bg-[#0b1220] border border-[#334155] text-white p-2 rounded"></div>
        </div>
        <button class="bg-indigo-600 text-white px-6 py-2 rounded font-bold w-full">Save Commission Rules</button>
    </div>
</div>
@endsection