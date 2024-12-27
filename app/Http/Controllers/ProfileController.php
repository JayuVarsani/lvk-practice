<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $admin=Auth::guard('admin')->user();
        return view('profile', ['title' => 'Update Profile', 'admin' => $admin]);
    }

    public function update_profile(Request $request)
    {
        $request->validate([
            'image' => 'image|max:10240',
            'name' => 'required',
            'email' => 'required|email',
        ],
            [
                'image.max' => 'Profile size should be less than 10MB',
            ]);
        $user = Auth::user();
        if ($request->hasFile('image')) {
            $user->clearMediaCollection('adminProfile');
            $user->addMediaFromRequest('image')->toMediaCollection('adminProfile');
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        session()->flash('alert', ['message' => 'Profile updated successfully', 'type' => 'success']);
        return redirect()->route('admin.dashboard');
    }

    public function render()
    {
        return view('change-password', ['title' => 'Change Password']);
    }

    public function change_password(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required',
            'password' => 'required|min:3',
            'confirmPassword' => 'required|same:password'
        ]);
        $user = Auth::user();
        if (!Hash::check($request->currentPassword, $user->password)) {
            session()->flash('alert', ['message' => 'Provided Password is incorrect', 'type' => 'danger']);
            return redirect()->route('admin.profile.change-password');
        }
        $user->update(['password' => $request->password]);
        session()->flash('alert', ['message' => 'Password updated successfully', 'type' => 'success']);
        return redirect()->route('admin.dashboard');
    }
}
