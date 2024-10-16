<?php

namespace App\Http\Controllers\API\advocacy_group;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\group_creation_request;
use App\Models\Admin;
use App\Models\Group;
use App\Models\Group_Member;
use App\Models\User;
use App\Traits\DocumentTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class group_controller extends Controller
{
    use DocumentTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user_id = Auth::user()->id;
            $group = Group_Member::with('group.group_members.users', 'group.events', 'group.posts.comments.replies', 'group.posts.likes')->where('user_id', $user_id)->get();
            return response()->json(
                [
                    'group' => $group,
                ],
                200,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'error' => $e->getMessage(),
                    'message' => 'something went wrong when processing your request',
                ],
                500,
            );
        }

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
    public function store(group_creation_request $request)
    {
        try {
            DB::beginTransaction();
            $user = User::find(Auth::user()->id);

            $user->user_type = 2;
            $user->save();

            $group_member = new Group_Member();
            $admin = new Admin();
            $group_data = $request->validated();


                        // Store the  documents
                        $legaldocsstring = $request->legal_docs;
                        $organisationID = $request->organisation_id;
                        $legaldocsurl = $this->storeBase64File($legaldocsstring, 'Files/groupLegalDocs');
                        // $report_url = $this->storeBase64File($report_string, 'Files/event_reports');
                        // return response()->json($report_url, 200);

            $group_data['admin_id'] = Auth::user()->id;
            $group_data['legal_docs'] = $legaldocsurl;
            $group_data['organisation_id'] = $organisationID;
            $created_group = Group::create($group_data);

            // extract created group infor
            $group_id = $created_group['id'];
            $admin_id = Auth::user()->id;

            //asign extracted infor to admin
            $admin['group_id'] = $group_id;
            $admin['user_id'] = $admin_id;

            //admin is also a member of the group
            $group_member['user_id'] = $admin_id;
            $group_member['group_id'] = $group_id;

            //create group admin with thir monitoring group
            $group_member->save();
            $admin->save();

            DB::commit();

            return response()->json(
                [
                    'message' => 'group created succesfull',
                    'group' => $created_group['name'],
                ],
                201,
            );
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(
                [
                    'error' => $e->getMessage(),
                    'message' => 'there was an error on processing your request',
                ],
                500,
            );
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
