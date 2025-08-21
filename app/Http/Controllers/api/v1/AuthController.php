<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($validate)) {
            $user = Auth::user();
            if ($user) {
                return response()->json([
                    'message' => 'Login successful',
                    'user' => $user,
                    'token' => $user->createToken('API Token')->plainTextToken,
                ]);
            }

        }


        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json(['message' => 'success register', $user], 200);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user?->currentAccessToken()->delete();
        return response()->json(['message' => 'success logout']);
    }

}
