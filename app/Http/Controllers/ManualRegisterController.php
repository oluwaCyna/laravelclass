<?php

namespace App\Http\Controllers;

use App\Mail\SendingMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

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

        event(new Registered($user));

        Mail::to($user->email)->send(new SendingMail($user));

        Auth::login($user);

        return redirect(route('home'));
 
     }
}
