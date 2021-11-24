<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Models\HotelUserInvitation;
use Illuminate\Support\Facades\Hash;
use App\Notifications\HotelUserInvitationNotification;

class UsersController extends Controller
{

    public function account()
    {
        return view('dashboard.account');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        $user = auth()->user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            return \redirect()->back()->with(['reset_success' => 'Password update successful']);
        }

        return redirect()->back()->withErrors(['current_password' => 'Invalid password']);
    }
}
