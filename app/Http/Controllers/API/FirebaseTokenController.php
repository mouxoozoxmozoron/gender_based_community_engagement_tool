<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FirebaseToken;
use Illuminate\Http\Request;

class FirebaseTokenController extends Controller
{
    public function saveToken(Request $request)
    {
        $request->validate([
            'token' => 'required|string|unique:firebase_tokens',
        ]);

        // Store the token in the database
        FirebaseToken::updateOrCreate(
            ['token' => $request->token], // Update if exists, otherwise create new
        );

        return response()->json(['message' => 'Token saved successfully.'], 200);
    }
}
