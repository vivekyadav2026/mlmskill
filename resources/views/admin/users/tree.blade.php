@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Genealogy Tree</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6">
        <p class="text-gray-400 mb-4">Visual representation of network hierarchy.</p>
        <ul class="text-gray-300 list-disc ml-6">
            @foreach($users as $u)
                <li><i class="fa-solid fa-user text-indigo-400 mr-2"></i> {{ $u->name }} ({{ $u->referral_code }})</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection