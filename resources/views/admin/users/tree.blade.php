@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Genealogy Tree</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6">
        <p class="text-gray-400 mb-4">Visual representation of network hierarchy.</p>
        <div class="overflow-x-auto pb-4">
            <ul class="text-gray-300 list-none">
                @foreach($users as $u)
                    @include('admin.users.partials.tree_node', ['user' => $u])
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection