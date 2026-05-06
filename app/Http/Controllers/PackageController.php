<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    public function upgrade()
    {
        $user = Auth::user();
        $balance = $user->wallet->package_wallet ?? 0;
        return view('user.package.upgrade', compact('user', 'balance'));
    }

    public function history()
    {
        $user = Auth::user();
        // Assuming a package_purchases table or just use user activation dates for now
        return view('user.package.history', compact('user'));
    }
}