<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $token = auth()->attempt($data);

        if($user = auth()->user()){
            return [
                'message' => 'Login successful',
                'auth' =>  [
                    'token' => $token,
                    'token_type' => 'Bearer',
                    'token_expire' => config('JWT_TTL'),
                    'refresh_expire' => config('JWT_REFRESH_TTL')
                ],
                'user' => $user,
                'billing' => $user->billing
            ];
        }

        return response()->json(['message' => 'Invalid login credentials'], 401);
        
    }

    public function regiterWithBilling(Request $request)
    {

        $billingData = $request->validate([
            'name' => 'required|string',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|string',
            'zip' => 'required',
            'city' => 'required|string',
            'region' => 'required|string',
            'country' => 'required|string',
        ]);

        $tempPass = Str::random(10);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($tempPass), // password
            'remember_token' => Str::random(10),
        ]);

        // $user->billing()->create($billingData);

        $token = auth()->login($user);

        return [
            'message' => 'Login successful',
            'auth' =>  [
                'token' => $token,
                'token_type' => 'Bearer',
                'token_expire' => config('JWT_TTL'),
                'refresh_expire' => config('JWT_REFRESH_TTL')
            ],
            'billing' => $user->billing
        ];
    }
}
