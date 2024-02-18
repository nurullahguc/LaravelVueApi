<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->all()))
            return response()->json(['status' => 401, 'message' => 'Login failed!'], 401);

        $user = Auth::user();
        $tokenLifetime = 5;
        $tokenResult = $user->createToken(
            'vue-app', ['*'], now()->addMinutes($tokenLifetime)
        )->plainTextToken;


        $now = now();
        $expiresAt = $now->addMinutes($tokenLifetime);

        return response()->json([
            'status' => 200,
            'message' => 'Login successfully!',
            'user' => $user,
            'token' => [
                'token' => $tokenResult,
                'expires_at' => $expiresAt->toDateTimeString()
            ]
        ], 200);
    }

    public function login_control()
    {
        if (Auth::guest())
            return response(['status' => 401, 'message' => 'Unauthanticatied!'], 401);
        else
            return response([
                'status' => 200,
                'message' => 'Welcome sir!',
                'user' => Auth::user(),
                'date_time' => Carbon::now()->format('d/m/Y H:i:s')
            ], 200);

    }
}

//test@example.com
//123456
