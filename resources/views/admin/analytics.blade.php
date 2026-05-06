@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Deep Analytics</h2></div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-[#1a222d] border border-[#334155] p-6 rounded-lg h-64 flex items-center justify-center text-gray-500">Revenue Growth Chart</div>
        <div class="bg-[#1a222d] border border-[#334155] p-6 rounded-lg h-64 flex items-center justify-center text-gray-500">User Retention Chart</div>
    </div>
</div>
@endsection