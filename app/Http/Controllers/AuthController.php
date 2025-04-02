<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    //
    public function register(Request $request) {
        try {
            $fields = $request->validate([
                'name' => 'required|max:40',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|max:16|regex:/[0-9]/|regex:/[a-z]/|regex:/[\W_]/'
            ]);

            $user = User::create([
                'name' => $fields['name'],
                'email' => $fields['email'],
                'password' => bcrypt($fields['password'])
            ]);

            $token = $user->createToken($request->name);

            return response()->json([
                'User' => $user,
                'Token' => $token->plainTextToken
            ], 201);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 422);
        }
    }

    public function login(Request $request) {
        try {
            $request->validate([
                'email' => 'required|email|exists:users',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return [
                    'message' => 'The provided credentials are incorrect',
                ];
            }

            $token = $user->createToken($user->name);

            return response()->json([
                'User' => $user,
                'Token' => $token->plainTextToken
            ], 201);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 422);
        }
    }


    public function logout(Request $request) {
        try {
            $request->user()->tokens()->delete();
            return response()->json([
                'message' => 'You are logged out'

            ]);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 422);
        }
    }
}
