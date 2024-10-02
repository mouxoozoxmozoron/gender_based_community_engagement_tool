<?php

namespace App\Http\Controllers\API\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserRegistrationRequest;
use App\Mail\mail_notify;
use App\Models\PasswordResetToken;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Exception;

use App\Models\User;
use App\Traits\SmsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

//let log to troubleshoot
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    use FileTrait;
    use SmsTrait;

    //function storeBase64File($base64String, $storagePath)
    // public function register(UserRegistrationRequest $request)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $userData = $request->validated();

    //         // Hash the password
    //         $userData['password'] = Hash::make($userData['password']);

    //         // Store the profile photo
    //         $photo_string = $userData['photo'];
    //         $profile_photo_url = $this->storeBase64File($photo_string, 'Files/profile_photo');
    //         $userData['photo'] = $profile_photo_url;
    //         $userData['user_type'] = 3;

    //         // Create the user
    //         $user = User::create($userData);

    //         // Create user token for authentication using Sanctum
    //         $token = $user->createToken('user-token')->plainTextToken;
    //         DB::commit();
    //         // Return success response
    //         return response()->json(
    //             [
    //                 'user' => User::where('email', $request->input('email'))->first(),
    //                 'token' => $token,
    //             ],
    //             201,
    //         );
    //     } catch (Exception $e) {
    //         // Handle any exceptions
    //         DB::rollback();
    //         Log::error('Error occurred during user registration: ' . $e->getMessage());
    //         return response()->json(['error' => 'User registration failed.', 'message' => $e->getMessage()], 500);
    //     }
    // }


    public function register(UserRegistrationRequest $request)
{
    try {
        DB::beginTransaction();

        // Get validated user data
        $userData = $request->validated();

        // Store the original password
        $originalUpass = $userData['password'];

        // Hash the password
        $userData['password'] = Hash::make($userData['password']);

        // Store the profile photo
        $photo_string = $userData['photo'];
        $profile_photo_url = $this->storeBase64File($photo_string, 'Files/profile_photo');
        $userData['photo'] = $profile_photo_url;
        $userData['user_type'] = 3;

        // Prepare the SMS message
        $uEmail = $userData['email'];
        $toFName = $userData['first_name'];
        $toLName = $userData['last_name'];
        $phoneNumber = $userData['phone'];

        $message = 'Hi ' . $toFName . ' ' . $toLName . ',' . ' Welcome to GBCE community, Advocacy equality for everyone. "You for her safety." Your login information are: ' . 'Email: ' . $uEmail . ', ' . 'Password: ' . $originalUpass . '. You can update this information using GBCE Mobile application.';

        // Create the user
        $user = User::create($userData);

        // Send SMS after the user has been created
        $response = $this->sendSms($message, $phoneNumber);

        // Create user token for authentication using Sanctum
        $token = $user->createToken('user-token')->plainTextToken;

        DB::commit();

        // Return success response
        return response()->json(
            [
                'user' => User::where('email', $request->input('email'))->first(),
                'token' => $token,
            ],
            201
        );
    } catch (Exception $e) {
        // Handle any exceptions
        DB::rollback();
        Log::error('Error occurred during user registration: ' . $e->getMessage());
        return response()->json(['error' => 'User registration failed.', 'message' => $e->getMessage()], 500);
    }
}


    public function changepassword(REQUEST $req)
    {
        try {
            DB::beginTransaction();
            $uid = Auth::user()->id;
            $user = User::where('id', $uid)->first();
            if (!Hash::check($req->input('old_password'), $user->password)) {
                DB::rollBack();
                return response()->json(['error' => 'Password does not match!'], 401);
            } else {
                $user->password = Hash::make($req->input('new_password'));
                $user->save();
                DB::commit();
                return response()->json(['message' => 'Password changed'], 201);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function sendOTP(Request $req)
    {
        try {
            DB::beginTransaction();

            $uemail = $req->email;
            $user = User::where('email', $uemail)->first();

            if ($user) {
                $token = rand(1000, 9999);

                $resttoken = PasswordResetToken::where('email', $uemail)->first();

                if ($resttoken) {
                    $resttoken->token = $token;
                    $newOTP = $resttoken->save();
                } else {
                    $resttoken = new PasswordResetToken();
                    $resttoken->email = $uemail;
                    $resttoken->token = $token;
                    $newOTP = $resttoken->save();
                }

                if ($newOTP) {
                    $data = [
                        'subject' => 'gbce account recovery',
                        'body' => 'Account recovery token: ' . $token . ' - keep this safe for confidentiality. Use it within 5 minutes.',
                    ];

                    $email = $uemail;

                    Mail::to($email)->send(new mail_notify($data));

                    DB::commit();

                    return response()->json(
                        [
                            'message' => 'We sent a verification token to your email, use it to reset your password',
                            'otp' => $token,
                        ],
                        201,
                    );
                } else {
                    DB::rollBack();
                    return response()->json('Something went wrong, try again later', 404);
                }
            } else {
                DB::rollBack();
                return response()->json('We could not find this account', 401);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'error' => $e->getMessage(),
                    'message' => 'An error occurred while processing the request',
                ],
                500,
            );
        }
    }

    public function verifyToken(Request $req)
    {
        try {
            $uemail = $req->email;
            $input_token = $req->token;

            $resttoken = PasswordResetToken::where('email', $uemail)->first();

            if ($resttoken && $resttoken->token == $input_token) {
                return response()->json(
                    [
                        'message' => 'Token verified successfully',
                    ],
                    200,
                );
            } else {
                return response()->json(
                    [
                        'message' => 'Token does not match',
                    ],
                    401,
                );
            }
        } catch (\Exception $e) {
            return response()->json(
                [
                    'error' => $e->getMessage(),
                    'message' => 'An error occurred while processing the request',
                ],
                500,
            );
        }
    }

    public function reset_password(Request $req)
    {
        try {
            $uemail = $req->email;
            $newPassword = $req->password;

            $user = User::where('email', $uemail)->first();

            if ($user) {
                $user->password = Hash::make($newPassword);
                $user->save();

                return response()->json(
                    [
                        'message' => 'Password updated successfully',
                    ],
                    201,
                );
            } else {
                return response()->json(
                    [
                        'message' => 'User not found',
                    ],
                    404,
                );
            }
        } catch (\Exception $e) {
            return response()->json(
                [
                    'error' => $e->getMessage(),
                    'message' => 'An error occurred while processing the request',
                ],
                500,
            );
        }
    }
}



// <?php

// namespace App\Http\Controllers\API\users;

// use App\Http\Controllers\Controller;
// use App\Http\Requests\Users\UserRegistrationRequest;
// use App\Mail\mail_notify;
// use App\Models\PasswordResetToken;
// use App\Traits\FileTrait;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Auth;

// use Exception;

// use App\Models\User;
// use App\Traits\SmsTrait;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;

// //let log to troubleshoot
// use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Mail;

// class UserController extends Controller
// {
//     use FileTrait;
//     use SmsTrait;

//     //function storeBase64File($base64String, $storagePath)
//     public function register(UserRegistrationRequest $request)
//     {
//         try {
//             DB::beginTransaction();
//             $userData = $request->validated();
//             $originalUpass = $request->validated(['password']);

//             // Hash the password
//             $userData['password'] = Hash::make($userData['password']);

//             // Store the profile photo
//             $photo_string = $userData['photo'];
//             $profile_photo_url = $this->storeBase64File($photo_string, 'Files/profile_photo');
//             $userData['photo'] = $profile_photo_url;
//             $userData['user_type'] = 3;

//             // $fName=Auth::user()->first_name;
//             // $lName=Auth::user()->last_name;
//             $uEmail=$userData['email'];
//             // $uPassword=$userData['password'];
//             $uPassword=$originalUpass;
//             $toFName=$userData['first_name'];
//             $toLName=$userData['last_name'];

//             $phoneNumber=$userData['phone'];
//             // $message = "Hi " . $toFName . " " . $toLName . "," .
//             // " You were added by " . $fName . " " . $lName . " to GBCE community. Use this credential to log in to your account: " .
//             // "Email: " . $uEmail . ", " . "Password: " . $uPassword . ". You can change this in the app.";


//             $phoneNumber = $userData['phone'];
//             $message = 'Hi ' . $toFName . ' ' . $toLName . ',' . ' Welcome to GBCE community, Advocacy equality for every one. "You for her safety" Your login information are: ' . 'Email: ' . $uEmail . ', ' . 'Password: ' . $uPassword . '. You can update this information using GBCE Mobile application.';

//             $newuser = User::create($userData);

//             $response = $this->sendSms($message, $phoneNumber);
//             // Create the user
//             $user = User::create($userData);

//             // Create user token for authentication using Sanctum
//             $token = $user->createToken('user-token')->plainTextToken;
//             $response = $this->sendSms($message, $phoneNumber);

//             DB::commit();
//             // Return success response
//             return response()->json(
//                 [
//                     'user' => User::where('email', $request->input('email'))->first(),
//                     'token' => $token,
//                 ],
//                 201,
//             );
//         } catch (Exception $e) {
//             // Handle any exceptions
//             DB::rollback();
//             Log::error('Error occurred during user registration: ' . $e->getMessage());
//             return response()->json(['error' => 'User registration failed.', 'message' => $e->getMessage()], 500);
//         }
//     }

//     public function changepassword(REQUEST $req)
//     {
//         try {
//             DB::beginTransaction();
//             $uid = Auth::user()->id;
//             $user = User::where('id', $uid)->first();
//             if (!Hash::check($req->input('old_password'), $user->password)) {
//                 DB::rollBack();
//                 return response()->json(['error' => 'Password does not match!'], 401);
//             } else {
//                 $user->password = Hash::make($req->input('new_password'));
//                 $user->save();
//                 DB::commit();
//                 return response()->json(['message' => 'Password changed'], 201);
//             }
//         } catch (\Exception $e) {
//             DB::rollback();
//             return response()->json(['error' => $e->getMessage()], 500);
//         }
//     }

//     public function sendOTP(Request $req)
//     {
//         try {
//             DB::beginTransaction();

//             $uemail = $req->email;
//             $user = User::where('email', $uemail)->first();

//             if ($user) {
//                 $token = rand(1000, 9999);

//                 $resttoken = PasswordResetToken::where('email', $uemail)->first();

//                 if ($resttoken) {
//                     $resttoken->token = $token;
//                     $newOTP = $resttoken->save();
//                 } else {
//                     $resttoken = new PasswordResetToken();
//                     $resttoken->email = $uemail;
//                     $resttoken->token = $token;
//                     $newOTP = $resttoken->save();
//                 }

//                 if ($newOTP) {
//                     $data = [
//                         'subject' => 'gbce account recovery',
//                         'body' => 'Account recovery token: ' . $token . ' - keep this safe for confidentiality. Use it within 5 minutes.',
//                     ];

//                     $email = $uemail;

//                     Mail::to($email)->send(new mail_notify($data));

//                     DB::commit();

//                     return response()->json(
//                         [
//                             'message' => 'We sent a verification token to your email, use it to reset your password',
//                             'otp' => $token,
//                         ],
//                         201,
//                     );
//                 } else {
//                     DB::rollBack();
//                     return response()->json('Something went wrong, try again later', 404);
//                 }
//             } else {
//                 DB::rollBack();
//                 return response()->json('We could not find this account', 401);
//             }
//         } catch (\Exception $e) {
//             DB::rollBack();
//             return response()->json(
//                 [
//                     'error' => $e->getMessage(),
//                     'message' => 'An error occurred while processing the request',
//                 ],
//                 500,
//             );
//         }
//     }

//     public function verifyToken(Request $req)
//     {
//         try {
//             $uemail = $req->email;
//             $input_token = $req->token;

//             $resttoken = PasswordResetToken::where('email', $uemail)->first();

//             if ($resttoken && $resttoken->token == $input_token) {
//                 return response()->json(
//                     [
//                         'message' => 'Token verified successfully',
//                     ],
//                     200,
//                 );
//             } else {
//                 return response()->json(
//                     [
//                         'message' => 'Token does not match',
//                     ],
//                     401,
//                 );
//             }
//         } catch (\Exception $e) {
//             return response()->json(
//                 [
//                     'error' => $e->getMessage(),
//                     'message' => 'An error occurred while processing the request',
//                 ],
//                 500,
//             );
//         }
//     }

//     public function reset_password(Request $req)
//     {
//         try {
//             $uemail = $req->email;
//             $newPassword = $req->password;

//             $user = User::where('email', $uemail)->first();

//             if ($user) {
//                 $user->password = Hash::make($newPassword);
//                 $user->save();

//                 return response()->json(
//                     [
//                         'message' => 'Password updated successfully',
//                     ],
//                     201,
//                 );
//             } else {
//                 return response()->json(
//                     [
//                         'message' => 'User not found',
//                     ],
//                     404,
//                 );
//             }
//         } catch (\Exception $e) {
//             return response()->json(
//                 [
//                     'error' => $e->getMessage(),
//                     'message' => 'An error occurred while processing the request',
//                 ],
//                 500,
//             );
//         }
//     }
// }
