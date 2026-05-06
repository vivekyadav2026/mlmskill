<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function system() { return view('user.notifications.system'); }
    public function announcements() { return view('user.notifications.announcements'); }
}