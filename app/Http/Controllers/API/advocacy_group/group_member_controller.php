<?php

namespace App\Http\Controllers\API\advocacy_group;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserRegistrationRequest;
use App\Models\Group;
use App\Models\Group_Member;
use App\Models\User;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class group_member_controller extends Controller
{
    use FileTrait;
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
            $group_member = new Group_Member();

            // Hash the password
            $userData['password'] = Hash::make($userData['password']);

            // Store the profile photo
            $photo_string = $userData['photo'];
            $profile_photo_url = $this->storeBase64File($photo_string, 'Files/profile_photo');
            $userData['photo'] = $profile_photo_url;
            $userData['user_type'] = 3;

            // Create the user
            $user = User::create($userData);

            // Create user token for authentication using Sanctum
            // $token = $user->createToken('user-token')->plainTextToken;

            //asign created user to a group
            $created_user_id = $user['id'];
            //get group the user is suposed to belong
            $group_admin_id = Auth::user()->id;
            $group = Group::where('admin_id', $group_admin_id)->first();
            if (!$group) {
                return response()->json(['error' => 'Group not found for the admin user'], 404);
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
                    'user' => User::with('group_membership.group')->where('email', $request->input('email'))->first(),
                    // 'token' => $token,
                ],
                201,
            );
        } catch (Exception $e) {
            // Handle any exceptions
            DB::rollback();
            Log::error('Error occurred in groupmember controller: ' . $e->getMessage());
            return response()->json(['error' => 'failed to create new group member.', 'message' => $e->getMessage()], 500);
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
