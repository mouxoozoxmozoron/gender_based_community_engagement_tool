<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserRegistrationRequest;
use App\Models\Booking;
use App\Models\Event;
use App\Models\Feedbac;
use App\Models\Group;
use App\Models\Group_Member;
use App\Models\Insight;
use App\Models\OrganisationAdmin;
use App\Models\Post;
use App\Models\User;
use App\Traits\FileTrait;
use App\Traits\SmsTrait;
use AWS\CRT\Log;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            $user = User::where('email', $req->input('email'))->first();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Incorrect email or password']);
            }

            if (Hash::check($req->input('password'), $user->password)) {
                Auth::login($user);

                $group = Group::where('admin_id', $user->id)->get();
                $req->session()->put('user_groups', $group);
                $req->session()->put('user_id', $user->id);
                $req->session()->put('user_object', $user);

                return response()->json(['success' => true, 'redirect' => url('/')]);
            } else {
                return response()->json(['success' => false, 'message' => 'Incorrect email or password']);
            }
        } catch (\Exception $e) {
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
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Failed to send SMS.',
                        'error' => $response,
                    ],
                    500,
                );
            }
        } catch (\Exception $e) {
            // Return the exact error message
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'An error occurred while sending SMS.',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function registration_check(Request $req)
    {
        try {
            DB::beginTransaction();

            $newuser = new User();
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

                $newuser->photo = $profile_photo_url;
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

    public function Profile()
    {
        $groupdata = '';
        return view('screens.profile', compact('groupdata'));
    }

    public function ProfileView()
    {
        $user = User::with('user_type')
            ->where('id', Auth::user()->id)
            ->first();
            $uID = $user->id;
            $uEmail = $user->email;
            $userorganiCount = OrganisationAdmin::where('user_id', $uID)->where('archive', 0)->count();
            $usergroupCount = Group::where('admin_id', $uID)->where('archive', 0)->count();
            $usermembershipCount = Group_Member::where('user_id', $uID)->where('archive', 0)->count();
            $userpostCount = Post::where('user_id', $uID)->where('archive', 0)->count();
            $usereventCount = Event::where('user_id', $uID)->where('archive', 0)->count();
            $userattendeventcount = Booking::where('user_id', $uID)->count();
            $userfeedbackCount = Feedbac::where('user_id', $uID)->count();
            $userinsightCount = Insight::where('email', $uEmail)->count();
        // return response()->json($user);
        return view('screens.view_profile', compact([
            'user',
            'userorganiCount',
            'usergroupCount',
            'usermembershipCount',
            'userpostCount',
            'usereventCount',
            'userattendeventcount',
            'userfeedbackCount',
            'userinsightCount',
        ]));
    }

    public function UpdateProfile(Request $request)
    {
        // Get the authenticated user
        // $userdata = new User();
        $userdata = Auth::user();

        // Validate form data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $userdata->id,
            'phone' => 'required|string|max:15',
            'gender' => 'required|in:male,female',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Image validation
        ]);

        try {
            // Handle image upload via base64 encoding
            if ($request->hasFile('profile_image')) {
                // Check if user already has an existing profile image
                if ($userdata->photo) {
                    // Extract the path from the URL and delete the existing image from storage
                    $existingImagePath = str_replace('/storage/', '', $userdata->photo);
                    Storage::delete($existingImagePath);
                }

                // Process new profile image
                $image = $request->file('profile_image');
                $image_base64 = base64_encode(file_get_contents($image->getRealPath()));

                // Store the base64-encoded image file and get the storage URL
                $profile_photo_url = $this->storeBase64File($image_base64, 'Files/profile_photo');

                // Update the photo field with the new URL
                $userdata->photo = $profile_photo_url;
            }

            // Update user fields
            $userdata->first_name = $request->input('first_name');
            $userdata->last_name = $request->input('last_name');
            $userdata->email = $request->input('email');
            $userdata->phone = $request->input('phone');
            $userdata->gender = $request->input('gender');

            $saveduser = $userdata->save();
            // Save the updated user
            if ($saveduser) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Profile updated successfully!',
                    'user' => $userdata, // Return updated user data if needed
                ],200);
            } else {
                return response()->json(
                    [
                        'status' => 500,
                        'message' => 'Failed to update profile. Please try again.',
                    ],
                    500,
                );
            }
        } catch (Exception $e) {
            // Log the error for further investigation
            //   \Log::error('Profile update failed: ' . $e->getMessage());

            return response()->json(
                [
                    'status' => 500,
                    'message' => 'An error occurred while updating your profile. Please try again later.',
                    'error' => $e->getMessage(), // Optionally, include the error message for debugging
                ],
                500,
            );
        }
    }
}
