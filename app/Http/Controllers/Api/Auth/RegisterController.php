<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        try {
            $credentials = Validator::make($request->all(), [
                'name' => ['required'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required'],
            ]);

            if ($credentials->fails()) {
                return response($credentials->errors(), 400);
            }
            $validated = $credentials->validated();

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            $token = $user->createToken('auth_token')->accessToken;

            return response([
                'token' => $token,
                'user' => $user,
            ], 200);

    } catch (Exception $e) {
        return response(('Something went wrong'), 500);
        // return response($e->getMessage(), 500);
    }
    }
}
