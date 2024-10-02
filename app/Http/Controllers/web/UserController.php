<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserRegistrationRequest;
use App\Models\Group;
use App\Models\User;
use App\Traits\FileTrait;
use App\Traits\SmsTrait;
use AWS\CRT\Log;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use FileTrait;
    use SmsTrait;

    // public function login_check(REQUEST $req)
    // {
    //     try {
    //         $user = User::where('email', $req->input('email'))->first();
    //         if (!$user) {
    //             return response()->json(['success' => false, 'message' => 'Incorrect email or password']);
    //         } else {
    //             if ($user && Hash::check($req->input('password'), $user->password)) {
    //                 $group = Group::where('admin_id', $user->id)->get();
    //                 $req->session()->put('user_groups', $group);
    //                 $req->session()->put('user_id', $user->id);
    //                 $req->session()->put('user_object', $user);

    //                 return response()->json(['success' => true, 'redirect' => url('/')]);
    //             } else {
    //                 return response()->json(['success' => false, 'message' => 'Incorrect email or password']);
    //             }
    //         }
    //     } catch (\Exception $e) {
    //         //throw $th;
    //         return response()->json(
    //             [
    //                 'error' => $e->getMessage(),
    //             ],
    //             500,
    //         );
    //     }
    // }


    public function login_check(Request $req)
{
    try {
        // Fetch the user by email
        $user = User::where('email', $req->input('email'))->first();

        // If the user is not found, return an error
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Incorrect email or password']);
        }

        // Check if the password matches
        if (Hash::check($req->input('password'), $user->password)) {
            // Log the user in using Laravel's Auth system
            Auth::login($user); // This allows Auth::user() to work in Blade

            // Add additional session data as needed
            $group = Group::where('admin_id', $user->id)->get();
            $req->session()->put('user_groups', $group);
            $req->session()->put('user_id', $user->id);
            $req->session()->put('user_object', $user);

            return response()->json(['success' => true, 'redirect' => url('/')]);
        } else {
            // If the password is incorrect, return an error
            return response()->json(['success' => false, 'message' => 'Incorrect email or password']);
        }
    } catch (\Exception $e) {
        // Handle any unexpected exceptions
        return response()->json(
            [
                'error' => $e->getMessage(),
            ],
            500,
        );
    }
}

    public function sendTestSms()
    {
        $message = 'This is a testing message';
    $phoneNumber = 'o713074067'; // Should be in international format, like +255745450431

    try {
        // Call the trait method
        $response = $this->sendSms($message, $phoneNumber);

        if (is_array($response) && isset($response['status']) && $response['status'] === 'success') {
            return response()->json([
                'status' => 'success',
                'message' => 'SMS sent successfully!',
                'data' => $response,
            ]);
        } else {
            // If the response is an error message
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send SMS.',
                'error' => $response,
            ], 500);
        }
    } catch (\Exception $e) {
        // Return the exact error message
        return response()->json([
            'status' => 'error',
            'message' => 'An error occurred while sending SMS.',
            'error' => $e->getMessage(),
        ], 500);
    }
    }



    public function registration_check(Request $req)
    {
        try {
            DB::beginTransaction();

            $newuser = new User;
            $newuser->first_name = $req->first_name;
            $newuser->last_name = $req->last_name;
            $newuser->gender = $req->gender;
            $newuser->phone = $req->phone;
            $newuser->email = $req->email;
            $newuser->password = Hash::make($req->password);
            $newuser->user_type = 3;

            if ($req->hasFile('profile_image')) {
                $image = $req->file('profile_image');
                $image_base64 = base64_encode(file_get_contents($image->getRealPath()));

                $profile_photo_url = $this->storeBase64File($image_base64, 'Files/profile_photo');

                $newuser->photo= $profile_photo_url;
            }

            $user = $newuser->save();

            if ($user) {
                DB::commit();
                return response()->json(['success' => true, 'redirect' => url('/')]);
            } else {
                DB::rollback();
                return response()->json(['success' => false, 'message' => 'Something went wrong, try again later']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
