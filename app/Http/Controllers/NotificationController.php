<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;

class NotificationController extends Controller
{
    public function system() 
    { 
        $user = Auth::user();
        $notifications = $user->notifications()->paginate(15);
        $user->unreadNotifications->markAsRead();
        return view('user.notifications.system', compact('notifications')); 
    }
    
    public function announcements() 
    { 
        $announcements = Announcement::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('user.notifications.announcements', compact('announcements')); 
    }
}