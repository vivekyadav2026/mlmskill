@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-2xl mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Manual Token Credit</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6">
        <form onsubmit="event.preventDefault(); alert('Tokens Credited successfully!');">
            <div class="mb-4"><label class="block text-gray-300 mb-2">Select User</label><input type="text" placeholder="Search by email..." class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded"></div>
            <div class="mb-4"><label class="block text-gray-300 mb-2">Token Type</label><select class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded"><option>Utility Token</option><option>Renewal Token</option></select></div>
            <div class="mb-6"><label class="block text-gray-300 mb-2">Amount</label><input type="number" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required></div>
            <button class="bg-indigo-600 text-white px-6 py-2 rounded font-bold w-full">Dispatch Tokens</button>
        </form>
    </div>
</div>
@endsection