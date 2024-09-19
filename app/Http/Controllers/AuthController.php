<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        $validatedData['password'] = bcrypt($request->password);

        $user = User::create($validatedData);

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->sendResponse($token, 'User registered.');
    }

    public function login(Request $request): JsonResponse
    {
        if (Auth::attempt($request->only('username', 'password'))) {
            $user = Auth::user();
            $success['token'] = $user->createToken('auth_token')->plainTextToken;
            $success['name'] = $user->name;

            return $this->sendResponse($success, 'User logged in.');
        }

        return response()->json([
            'message' => 'Username or password is incorrect.',
        ], 401);
    }
}
