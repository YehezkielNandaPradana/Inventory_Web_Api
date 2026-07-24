<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($request->only('username', 'password'))) {
            return response()->json([
                'message' => 'Username atau password salah',
            ], 401);
        }

        $user = Auth::user();

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'role' => $user->role,
            ],
            'message' => 'Login berhasil',
        ]);
    }

    public function profile(Request $request)
    {
        $request->validate([
            'user_id' => ['nullable', 'exists:users,id'],
        ]);

        $user = $request->filled('user_id')
            ? User::findOrFail($request->input('user_id'))
            : User::first();

        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'role' => $user->role,
            ],
        ]);
    }
}
