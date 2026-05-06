@extends('layouts.user')

@section('content')

<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden max-w-4xl mx-auto">
        <div class="px-6 py-8 border-b border-gray-200 text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100 mb-4">
                <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $title }}</h2>
            <p class="text-gray-500 text-lg">Path: User / {{ $path }}</p>
        </div>
        <div class="px-6 py-8 text-center bg-gray-50">
            <h3 class="text-xl font-medium text-gray-900 mb-2">Under Construction</h3>
            <p class="text-gray-500 max-w-lg mx-auto">
                This section of the MLM dashboard is currently being integrated. 
                Data and functionality for <strong>{{ $title }}</strong> will be available soon.
            </p>
            <div class="mt-8">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                    &larr; Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
