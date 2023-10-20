<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function get(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->save();
        return response($user);
    }

    public function post(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->save();
        return response($user);
    }
}
