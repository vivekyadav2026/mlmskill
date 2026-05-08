@extends('admin.support.index')

@section('chat_box')
<div class="card bg-dark border-secondary h-100 d-flex flex-column" style="min-height: 500px;">
    <div class="card-header border-secondary d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-white">
            Chat with {{ $activeUser->name }} 
            <span class="badge bg-secondary ms-2" style="font-size: 0.7rem;">ID: {{ $activeUser->id }}</span>
            @if($activeUser->sponsor_id)
                <span class="badge bg-info text-dark ms-2" style="font-size: 0.7rem;">Sponsor: {{ $activeUser->sponsor_id }}</span>
            @endif
        </h5>
        <div class="d-flex align-items-center gap-3">
            <span class="badge bg-info">{{ $activeUser->phone }}</span>
            <form action="{{ url('admin/support/' . $activeUser->id . '/delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this entire conversation?');" class="m-0">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" title="Delete Conversation"><i class="fa-solid fa-trash"></i></button>
            </form>
        </div>
    </div>
    <div class="card-body overflow-auto d-flex flex-column gap-3" id="adminChatMessages" style="max-height: 400px; scroll-behavior: smooth;">
        @forelse($messages as $msg)
            <div class="d-flex w-100 {{ $msg->sender == 'admin' ? 'justify-content-end' : 'justify-content-start' }}">
                <div class="p-2 rounded {{ $msg->sender == 'admin' ? 'bg-primary text-white' : 'bg-secondary text-white' }}" style="max-width: 75%;">
                    {{ $msg->message }}
                    <div class="text-end mt-1" style="font-size: 0.65rem; opacity: 0.7;">
                        {{ $msg->created_at->format('M d, H:i') }}
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-muted">No messages yet.</div>
        @endforelse
    </div>
    <div class="card-footer border-secondary">
        <form id="adminChatForm" class="d-flex gap-2">
            <input type="text" id="adminChatMessage" class="form-control bg-dark text-white border-secondary" placeholder="Type a reply..." required autocomplete="off">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i></button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatForm = document.getElementById('adminChatForm');
    const messageInput = document.getElementById('adminChatMessage');
    const messagesContainer = document.getElementById('adminChatMessages');
    const userId = {{ $activeUser->id }};
    let lastMessageCount = {{ count($messages) }};

    // Scroll to bottom
    messagesContainer.scrollTop = messagesContainer.scrollHeight;

    function fetchMessages() {
        fetch('/admin/support/' + userId + '/messages')
            .then(res => res.json())
            .then(data => {
                if (data.messages.length > lastMessageCount) {
                    // Only append new messages
                    for(let i = lastMessageCount; i < data.messages.length; i++) {
                        appendMessage(data.messages[i]);
                    }
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                    lastMessageCount = data.messages.length;
                }
            })
            .catch(err => console.error(err));
    }

    function appendMessage(msg) {
        const div = document.createElement('div');
        div.className = `d-flex w-100 ${msg.sender === 'admin' ? 'justify-content-end' : 'justify-content-start'}`;
        
        const date = new Date(msg.created_at);
        const timeStr = date.toLocaleDateString() + ' ' + date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

        div.innerHTML = `
            <div class="p-2 rounded ${msg.sender === 'admin' ? 'bg-primary text-white' : 'bg-secondary text-white'}" style="max-width: 75%;">
                ${msg.message}
                <div class="text-end mt-1" style="font-size: 0.65rem; opacity: 0.7;">
                    ${timeStr}
                </div>
            </div>
        `;
        messagesContainer.appendChild(div);
    }

    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const msg = messageInput.value.trim();
        if(!msg) return;

        messageInput.value = '';
        messageInput.disabled = true;

        fetch('/admin/support/' + userId + '/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: msg })
        })
        .then(res => res.json())
        .then(data => {
            messageInput.disabled = false;
            messageInput.focus();
            if(data.success) {
                appendMessage(data.message);
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
                lastMessageCount++;
            }
        });
    });

    // Auto refresh
    setInterval(fetchMessages, 1500);
});
</script>
@endsection
