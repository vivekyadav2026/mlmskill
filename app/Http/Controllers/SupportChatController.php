<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportChat;
use Illuminate\Support\Facades\Auth;

class SupportChatController extends Controller
{
    public function unreadCount()
    {
        $count = SupportChat::where('user_id', Auth::id())->where('sender', 'admin')->where('is_read', false)->count();
        return response()->json(['unread' => $count]);
    }

    public function fetchMessages()
    {
        $messages = SupportChat::where('user_id', Auth::id())->orderBy('created_at', 'asc')->get();
        // Mark admin messages as read
        SupportChat::where('user_id', Auth::id())->where('sender', 'admin')->update(['is_read' => true]);
        
        return response()->json(['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $request->validate(['message' => 'required|string']);

        $message = SupportChat::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'sender' => 'user'
        ]);

        return response()->json(['success' => true, 'message' => $message]);
    }
}
