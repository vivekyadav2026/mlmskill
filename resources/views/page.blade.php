@extends('layouts.guest')

@section('content')
<div class="py-20 bg-[#0b1220] min-h-screen">
    <div class="container mx-auto px-4 mt-10">
        <div class="max-w-4xl mx-auto bg-[#1a222d] rounded-2xl shadow-2xl border border-[#334155] overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-900 to-[#1a222d] px-8 py-10 border-b border-[#334155]">
                <h1 class="text-4xl font-bold text-white">{{ $page->title }}</h1>
            </div>
            
            <!-- Standard Typography formatting for the raw HTML content -->
            <div class="p-8 text-gray-300 prose prose-invert prose-indigo max-w-none">
                {!! $page->content !!}
            </div>
            
            <div class="bg-[#0f172a] px-8 py-4 border-t border-[#334155] text-sm text-gray-500 text-center">
                Last updated on {{ $page->updated_at->format('F d, Y') }}
            </div>
        </div>
    </div>
</div>
@endsection
