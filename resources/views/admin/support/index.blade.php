@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 fw-bold text-white mb-0">Support Center</h2>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card bg-dark border-secondary">
            <div class="card-header border-secondary">
                <h5 class="mb-0 text-white">Active Chats</h5>
            </div>
            <div class="list-group list-group-flush">
                @forelse($users as $user)
                    <a href="{{ route('admin.support.chat', $user->id) }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary {{ isset($activeUser) && $activeUser->id == $user->id ? 'active bg-primary' : '' }}">
                        <div class="d-flex w-100 justify-content-between align-items-center">
                            <h6 class="mb-1">{{ $user->name }} 
                                <span class="badge bg-secondary ms-1">ID: {{ $user->id }}</span>
                                @if($user->sponsor_id)
                                    <span class="badge bg-info text-dark ms-1">Sponsor: {{ $user->sponsor_id }}</span>
                                @endif
                            </h6>
                            @if($user->support_chats_count > 0)
                                <span class="badge bg-danger rounded-pill">{{ $user->support_chats_count }}</span>
                            @endif
                        </div>
                        <small class="text-muted">{{ $user->email }}</small>
                    </a>
                @empty
                    <div class="list-group-item bg-dark text-muted border-secondary text-center">
                        No support messages yet.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-md-8">
        @yield('chat_box')
    </div>
</div>
@endsection
