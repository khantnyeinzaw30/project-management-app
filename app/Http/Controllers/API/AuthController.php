<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // user register
    public function register(RegisterRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone
        ];

        $user = User::create($data);
        $tokenResult = $user->createToken('api token');
        return response()->json([
            'status' => true,
            'message' => 'Account registeration completed successfully',
            'token' => $tokenResult->plainTextToken
        ]);
    }

    // user login
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        return response()->json([
            'user' => $user
        ]);
    }
}
