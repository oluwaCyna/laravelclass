<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ManualRegisterController extends Controller
{
    public function manualR()
    {
        return view('auth.manual-register');
    }

    public function manualRegister(Request $request)
    {
        // dd(Auth::user());
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);
        // dd($credentials);
        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
        ]);

        Auth::login($user);
 
     }
}
