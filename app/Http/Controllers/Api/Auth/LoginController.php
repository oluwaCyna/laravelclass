<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request) 
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if ($validator->fails()) {
                return response($validator->errors(), 400);
            }

            $validated = $validator->validated();

            if (Auth::attempt($validated)) {
                $user = Auth::user();
                $token = $user->createToken('auth_token')->accessToken;

                return response([
                    'token' => $token,
                    'user' => $user,
                ], 200);
            }

            return response(('Email or Password is invalid'), 500);
 
        } catch (Exception $e) {
            // return response(('Something went wrong'), 500);
            return response($e->getMessage(), 500);
        }
    }
}
