<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('user.profile.edit', compact('user'));
    }

    public function password()
    {
        $user = Auth::user();
        return view('user.profile.password', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip' => 'nullable|string|max:20',
        ]);

        if ($request->hasFile('profile_image')) {
            $imageName = time().'.'.$request->profile_image->extension();  
            $request->profile_image->move(public_path('images/profiles'), $imageName);
            $user->profile_image = 'images/profiles/'.$imageName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->zip = $request->zip;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully!');
    }

    public function idCard()
    {
        $user = Auth::user();
        if ($user->status !== 'active') {
            return redirect()->route('dashboard')->with('error', 'You must activate your account to generate an ID card.');
        }
        return view('user.id-card', compact('user'));
    }
}
