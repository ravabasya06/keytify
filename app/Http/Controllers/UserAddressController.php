<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\UserAddress;

class UserAddressController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'address'     => 'required|string|max:500',
            'city'        => 'required|string|max:255',
            'province'    => 'required|string|max:255',
            'island'      => 'required|string|max:255',
            'postal_code' => 'required|max:10',
            'phone_number'=> 'required|max:20',
        ]);

        UserAddress::create($validated);

        return Redirect::back()->with('message', 'Profile updated successfully!');
    }

    public function update(Request $request, $id)
    {
        $address = UserAddress::where('user_address_id', $id);

        $validated = $request->validate([
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'address'     => 'required|string|max:500',
            'city'        => 'required|string|max:255',
            'province'    => 'required|string|max:255',
            'island'      => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'phone_number'=> 'required|string|max:20',
        ]);

        $address->update($validated);

        return Redirect::back()->with('message', 'Profile updated successfully!');
    }

    public function destroy()
    {
        $address = UserAddress::where('user_id', Auth::id());
        $address->delete();

        return Redirect::back()->with('message', 'Address deleted successfully!');
    }
}
