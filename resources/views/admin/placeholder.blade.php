@extends('layouts.admin')

@section('content')

<style>
  .app-main { padding: 20px; }
  .tailwind-scope h3 { margin-bottom: 0; }
</style>
<div class="tailwind-scope mt-4">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden max-w-4xl mx-auto">
        <div class="px-6 py-8 border-b border-gray-200 text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 mb-4">
                <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $title }}</h2>
            <p class="text-gray-500 text-lg">Path: Admin / {{ $path }}</p>
        </div>
        <div class="px-6 py-8 text-center bg-gray-50">
            <h3 class="text-xl font-medium text-gray-900 mb-2">System Module Pending</h3>
            <p class="text-gray-500 max-w-lg mx-auto">
                The <strong>{{ $title }}</strong> module is currently being built out in the new MLM structure.
            </p>
            <div class="mt-8">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700">
                    &larr; Back to Overview
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
