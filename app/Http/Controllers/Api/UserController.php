<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user(Request $request) 
    {
        try {
            $all_users = User::find($request->user_id);
            return response($all_users);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
