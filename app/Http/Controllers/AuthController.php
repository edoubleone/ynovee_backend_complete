<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Allow login with either username or email
        $request->validate([
            'username' => 'required_without:email|string',
            'email' => 'required_without:username|string',
            'password' => 'required',
        ]);

        $credentials = $request->only('password');
        
        if ($request->has('username')) {
            $credentials['username'] = $request->input('username');
        } elseif ($request->has('email')) {
             $credentials['email'] = $request->input('email');
        }

        // If 'login' field is used (common pattern), check it
        if ($request->has('login')) {
             $login = $request->input('login');
             $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
             $credentials = [
                 $fieldType => $login,
                 'password' => $request->input('password')
             ];
        }

        if (!isset($credentials['username']) && !isset($credentials['email'])) {
             // Fallback for weird edge cases or strict validation fail
             return response()->json(['message' => 'Username or Email is required'], 422);
        }

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('admin-token')->plainTextToken;
            return response()->json(['token' => $token, 'user' => $user]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
