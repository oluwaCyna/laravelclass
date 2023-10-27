<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user(Request $request) 
    {
        try {
            return response('ooo');
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
