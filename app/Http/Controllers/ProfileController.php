<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\UserAddress;

class ProfileController extends Controller
{
    public function index(){
        $id = Auth::id();
        $user_address = UserAddress::where('user_id', $id)->first();
        
        return Inertia::render('Profile', [
            'user_address' => $user_address,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::route('login')->with('message', 'You logged out of an account');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|email:rfc,dns',
        ]);

        $user->update($validated);

        return Redirect::back()->with('message', 'Profile updated successfully!');
    }
}
