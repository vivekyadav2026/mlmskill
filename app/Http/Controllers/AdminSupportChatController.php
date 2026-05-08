<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportChat;
use App\Models\User;

class AdminSupportChatController extends Controller
{
    public function unreadCount()
    {
        $count = SupportChat::where('sender', 'user')->where('is_read', false)->count();
        return response()->json(['unread' => $count]);
    }

    public function index()
    {
        $users = User::whereHas('supportChats')->withCount(['supportChats' => function($query) {
            $query->where('sender', 'user')->where('is_read', false);
        }])->with(['supportChats' => function($query) {
            $query->latest()->limit(1);
        }])->get()->sortByDesc(function($user) {
            return $user->supportChats->first()->created_at ?? now();
        });

        return view('admin.support.index', compact('users'));
    }

    public function chat($userId)
    {
        $users = User::whereHas('supportChats')->withCount(['supportChats' => function($query) {
            $query->where('sender', 'user')->where('is_read', false);
        }])->with(['supportChats' => function($query) {
            $query->latest()->limit(1);
        }])->get()->sortByDesc(function($user) {
            return $user->supportChats->first()->created_at ?? now();
        });

        $activeUser = User::findOrFail($userId);
        $messages = SupportChat::where('user_id', $userId)->orderBy('created_at', 'asc')->get();
        
        // Mark user messages as read
        SupportChat::where('user_id', $userId)->where('sender', 'user')->update(['is_read' => true]);

        return view('admin.support.chat', compact('users', 'activeUser', 'messages'));
    }

    public function fetchMessages($userId)
    {
        $messages = SupportChat::where('user_id', $userId)->orderBy('created_at', 'asc')->get();
        SupportChat::where('user_id', $userId)->where('sender', 'user')->update(['is_read' => true]);
        
        return response()->json(['messages' => $messages]);
    }

    public function sendMessage(Request $request, $userId)
    {
        $request->validate(['message' => 'required|string']);

        $message = SupportChat::create([
            'user_id' => $userId,
            'message' => $request->message,
            'sender' => 'admin'
        ]);

        return response()->json(['success' => true, 'message' => $message]);
    }

    public function deleteChat($userId)
    {
        SupportChat::where('user_id', $userId)->delete();
        return redirect()->route('admin.support.index')->with('success', 'Conversation with user ID ' . $userId . ' has been cleared.');
    }
}
