<?php

namespace App\Http\Controllers\API\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserRegistrationRequest;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Exception;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

//let log to troubleshoot
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    use FileTrait;

    //function storeBase64File($base64String, $storagePath)
    public function register(UserRegistrationRequest $request)
    {
        try {
            DB::beginTransaction();
            $userData = $request->validated();

            // Hash the password
            $userData['password'] = Hash::make($userData['password']);

            // Store the profile photo
            $photo_string = $userData['photo'];
            $profile_photo_url = $this->storeBase64File($photo_string, 'Files/profile_photo');
            $userData['photo'] = $profile_photo_url;
            $userData['user_type'] = 2;

            // Create the user
            $user = User::create($userData);

            // Create user token for authentication using Sanctum
            $token = $user->createToken('user-token')->plainTextToken;
            DB::commit();
            // Return success response
            return response()->json(
                [
                    'user' => User::where('email', $request->input('email'))->first(),
                    'token' => $token,
                ],
                201,
            );
        } catch (Exception $e) {
            // Handle any exceptions
            DB::rollback();
            Log::error('Error occurred during user registration: ' . $e->getMessage());
            return response()->json(['error' => 'User registration failed.', 'message' => $e->getMessage()], 500);
        }
    }
}
