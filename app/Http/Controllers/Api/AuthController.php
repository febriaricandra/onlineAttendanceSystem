<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        $user = User::where('email', $credentials['email'])->first();
        $token = $user->createToken('authToken')->plainTextToken;
        if(!$user){
            return response()->json([
                'success' => false,
                'message' => 'Email & password salah',
                'data' => ''
            ], 401);
        }
        if($user->password != $credentials['password']){
            return response()->json([
                'success' => false,
                'message' => 'Email & password salah',
                'data' => '',
            ], 401);
        }
        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => $user,
            'token' => $token
        ], 200);
    }
}
