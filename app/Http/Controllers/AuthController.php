<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|phone:PK',
            'password' => 'required|string|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'user_role_id' => 'required|integer',
        ]);

        if ($fields['user_role_id'] == 1) {
            return response()->json(['error' => 'something went worng.', 'success' => false], 404);
        }

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'phone' => $fields['phone'],
            'password' => bcrypt($fields['password']),
            'postal_address' => $request->postal_address,
            'jammat' => $request->jammat,
            'ammart_id' => $request->ammart_id,
            'halqa_id' => $request->halqa_id,
            'status' => $request->status || false,
            'user_role_id' => $fields['user_role_id'],
            'city' => $request->city,
            'deleted' => $request->deleted || false,
        ]);

        $response = [
            'message' => 'user craeted',
            'data' => $user,
            'success' => true,
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'exclude_with:phone|required|email',
            'phone' => 'exclude_with:email|required|phone:PK',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->orWhere('phone', $request->phone)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'wrong credentials',
                'success' => false
            ], 401);
        }

        $token = $user->createToken('appAuthToken')->plainTextToken;

        $response = [
            'message' => 'logged in',
            'data' => [
                'user' => $user,
                'token' => $token
            ],
            'success' => true,
        ];

        return response($response, 200);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response(['message' => 'Logged out', 'success' => true], 200);
    }
}
