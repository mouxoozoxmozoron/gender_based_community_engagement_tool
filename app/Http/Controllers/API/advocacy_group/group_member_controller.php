<?php

namespace App\Http\Controllers\API\advocacy_group;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserRegistrationRequest;
use App\Models\Group;
use App\Models\Group_Member;
use App\Models\User;
use App\Traits\FileTrait;
use App\Traits\SmsTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class group_member_controller extends Controller
{
    use FileTrait;
    use SmsTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRegistrationRequest $request)
    {
        try {
            DB::beginTransaction();
            $userData = $request->validated();
            $group_id = $userData['group_id'];
            $group_member = new Group_Member();

            $originalUpass = $request->validated(['password']);
            // Hash the password
            $userData['password'] = Hash::make($userData['password']);

            // Store the profile photo
            $photo_string = $userData['photo'];
            $profile_photo_url = $this->storeBase64File($photo_string, 'Files/profile_photo');
            $userData['photo'] = $profile_photo_url;
            $userData['user_type'] = 3;

            $fName = Auth::user()->first_name;
            $lName = Auth::user()->last_name;
            $uEmail = $userData['email'];
            // $uPassword = $userData['password'];
            $uPassword = $originalUpass;
            $toFName = $userData['first_name'];
            $toLName = $userData['last_name'];

            $phoneNumber = $userData['phone'];
            $group = Group::where('id', $group_id)->first();
            $groupNmae = $group->name;

            $message = 'Hi ' . $toFName . ' ' . $toLName . ',' . ' You were added by ' . $fName . ' ' . $lName . 'to ' . $groupNmae . ' Group as GBCE community member. Use this credential to log in to your account: ' . 'Email: ' . $uEmail . ', ' . 'Password: ' . $uPassword . '. Remember to update your login information for privancy, you can do this in GBCE app.';

            $newuser = User::create($userData);

            $response = $this->sendSms($message, $phoneNumber);

            //asign created user to a group
            $created_user_id = $newuser['id'];
            if (!$group) {
                return response()->json(['error' => 'Group not found'], 404);
            }
            $group_id = $group->id;

            $group_member['user_id'] = $created_user_id;
            $group_member['group_id'] = $group_id;
            //save new group member
            $group_member->save();
            DB::commit();
            // Return success response
            return response()->json(
                [
                    'message' => 'group member added succesfull',
                ],
                201,
            );
        } catch (Exception $e) {
            // Handle any exceptions
            DB::rollback();
            Log::error('Error occurred in groupmember controller: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage(), 'message' => 'failed to create new group membere'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
