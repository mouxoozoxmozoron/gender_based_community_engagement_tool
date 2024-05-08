<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        try {
            $user = User::where('email', $request->input('email'))->first();

            if (!$user) {
                return response()->json(['error' => 'Incorrect credentials.'], 401);
            }

            if (!Hash::check($request->input('password'), $user->password)) {
                return response()->json(['error' => 'Incorrect credentials.'], 401);
            }

            // Delete old user tokens if exists
            $user->tokens()->delete();

            // Generate user token using Sanctum
            $token = $user->createToken('user-token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token
            ], 200);
        } catch (Exception $e) {
            // Handle any exceptions
            Log::error('Error occurred during login: ' . $e->getMessage());
            return response()->json(['error' => 'Login failed.', 'message' => $e->getMessage()], 500);
        }




    }

    public function logout($userId) {
        $user = User::findOrFail($userId);
        //Delete user tokens
        $user->tokens()->delete();

        return response()->json(['message' => $user['UserName'] . ', You Logged out successfully'], 200);
    }
}
