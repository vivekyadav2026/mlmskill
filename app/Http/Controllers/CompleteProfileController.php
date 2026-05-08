<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompleteProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->is_profile_complete) {
            return redirect()->route('package.upgrade');
        }
        return view('user.complete-profile', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gender' => 'required|in:male,female,other',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:20',
            'mpin' => 'required|digits:4',
        ]);

        $user = Auth::user();
        
        if ($request->hasFile('profile_image')) {
            $imageName = time().'.'.$request->profile_image->extension();  
            $request->profile_image->move(public_path('images/profiles'), $imageName);
            $user->profile_image = 'images/profiles/'.$imageName;
        }

        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->zip = $request->zip;
        $user->mpin = \Illuminate\Support\Facades\Hash::make($request->mpin);
        $user->is_profile_complete = true;
        
        $user->save();

        return redirect()->route('package.upgrade')->with('success', 'Profile completed successfully! Please purchase your course to activate your account.');
    }
}
