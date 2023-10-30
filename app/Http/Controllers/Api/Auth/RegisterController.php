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
    /**
     * Register a new user
     * 
     * Use this endpoint to register a new user
     * 
     * @bodyParam name string required This is the name of the new user. Example: Mujeeeb
     * @bodyParam email string  This is the email of the new user
     * @bodyParam password string required This is the password of the new user
     * 
     * @response status=200 scenario="when user is registered successfully" { "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiODc2YmY1ODFkMmQ2Y2YzOGM1OWEzYmFkMDFlNjVmNzc0NTVhMWFkZDgxOWRlODA5MzI5ODRjMjIwNTA0ODc0MGE2OTcyYzcxYjVjYjcxZTkiLCJpYXQiOjE2OTg2NjIzMDEuNDMxMjM5LCJuYmYiOjE2OTg2NjIzMDEuNDMxMjQ1LCJleHAiOjE3MzAyODQ3MDEuMDM3NzA0LCJzdWIiOiIyMSIsInNjb3BlcyI6W119.jisjaYBphG1uvxn00gJ8r-jGNbbk-w4VbK2abpjdey6--4n0m6fgEW0sfJKEH_YmioL6ozICXasHIDQsIuM2QlAdULj7P6ioKzEWsIbaPCHIyv4z_9sqsYTqWiQs_CohEAgJEIj5l6lGPUVjfkzoAOFaTz61cYWTvEYQGIzvrOSv9RpWIGfqruSn5EK_CAFZwp3BUOAKXN9nZr6qHNtmtdHiw5o28WNIxE09uB0Zvx6rKVMQs2Wrs0xgpt6okaBGRAM2ggc5aYFWXwl1_AdAt6N3tdGZSzHt93_JbnfuKuU-stSwkgta6JrsFlSbXQkK9GxpIkLh-NpOmGzSivkmp5dZF4el8EV37Wy_dAnL34-01p5WCKsDmFXEEc6aU7BZ4DV82JqrW31YSmxnFKgJkDdT4UHRV4DdKhQtyvU2CE-r9Z8jdv8APv9yjF2sf4WSgw-BYCkjnIOhsTFndVsioNORi6bVJfae-sCKTOpaxbazHJfimzf74rtQ4NZRTauzXvCvTdX2p6IbKBK2btZnZ8CTK4Whzg8xZzcdQHlldLNYphcrhMr6oJ_NYnnYPvMI5XPAvVGb9vuO5dJbeo4T7PgBM_lKeWV-4jZRFltAgKTbNz4ZI2oKe5tC0CTZgav7OHXWVhQqw8oik_E9kMT-Xz1kAkkCSkJA5yAUDYzEZD4", "user": { "id": 3, "name": "Name", "email": "test@test.com", "email_verified_at": null, "created_at": "2023-10-27T11:14:48.000000Z", "updated_at": "2023-10-27T11:14:48.000000Z" } }
     * @response status=400 scenario="when validation fails" { "email": [ "The email field is required." ], "password": [ "The password field is required." ] }
     * @response status=500 scenario="Server error" { "Something went wrong" }
     */
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
