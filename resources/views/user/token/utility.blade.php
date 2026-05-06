@extends('layouts.user')

@section('content')

<style>.app-main { padding: 20px; }</style>
<div class="tailwind-scope mt-4">
    <div class="bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-[#334155] p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-100">Token Utility</h2>
            <p class="text-gray-400">Manage and view your Token Utility details.</p>
        </div>
        <div class="border-t border-[#334155] pt-6">
            <div class="p-10 text-center text-gray-500 bg-[#0b1220] rounded-lg border border-dashed border-[#334155]">
                <i class="fa-solid fa-gears text-4xl mb-3 text-indigo-500"></i>
                <h3 class="text-xl font-bold text-gray-300">Module Active</h3>
                <p class="mt-2">The Token Utility functionality is currently linked and ready for data binding.</p>
            </div>
        </div>
    </div>
</div>
@endsection
