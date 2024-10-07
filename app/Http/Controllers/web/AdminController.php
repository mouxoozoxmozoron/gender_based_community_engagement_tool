<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Organisation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    public function Dashboard(){

        // return response()->json($group);
        return view('screens/management/home_dashboard', [
            'groupdata' => '',
            'usercount' => '',
            'postcount' => '',
            'eventcount' => '',
        ]);
    }

    public function AllgroupMembers(){
        $users = User::where('user_type', 3)->get();
        return view('screens.management.systemAdmin.view_group_members', compact('users'));
    }


    public function AllGroupMnagers(){
        $users = User::
        with('groups')
        ->where('user_type', 2)
        ->get();
        return view('screens.management.systemAdmin.view_group_org', compact('users'));
    }


    public function AllOrganisationGroups($id){
        $groups = Group::with('user')
        ->where('archive', 0)
        ->where('organisation_id', $id)
        ->get();
        // return response()->json($groups);
        return view('screens.management.systemAdmin.view_org_group', compact('groups'));
    }

    public function AllOrganisations(){
        $organisations = Organisation::where('archive', 0)->get();
        return view('screens.management.systemAdmin.view_organisation', compact('organisations'));
    }


    public function SaveNewOrganisation(Request $request){

        $validator = Validator::make($request->all(), [
            'groupName' => 'required',
            'legaldocs' => 'required|file',
            'description' => 'required|string',
        ]);

        try {
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors(),
                'status' => 422
            ], 422);
        }
        if ($request->hasFile('legaldocs')) {
            $filePath = $request->file('legaldocs')->store('organisationLegalDocs', 'public');
            $fileUrl = Storage::url($filePath);
        }

          $createdorganisation =  Organisation::create([
                'legal_docs' => $fileUrl,
                'organisation_name' => $request->groupName,
                'description' => $request->description,
                'user_id'=>Auth()->user()->id,
                'status' => 0,
                'archive'=>0,
            ]);

            if ($createdorganisation) {
                return response()->json([
                'message' => 'Organisation created successfully!',
                'status' => 200
            ]);
            }else{
                return response()->json([
                'message' => 'There was a problem, try again!',
                'status' => 500
            ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to save organisation: ' . $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }


// Approve organisation
public function approveOrganisation($id)
{
    $organisation = Organisation::find($id);
    if ($organisation) {
        $organisation->status = 1; // or some appropriate status
        $organisation->save();
        return response()->json(['message' => 'Organisation approved successfully!', 'status' => 200]);
    }
    return response()->json(['message' => 'Organisation not found.', 'status' => 404]);
}

// Suspend organisation
public function suspendOrganisation($id)
{
    $organisation = Organisation::find($id);
    if ($organisation) {
        $organisation->status = 0; // or some appropriate status
        $organisation->save();
        return response()->json(['message' => 'Organisation suspended successfully!', 'status' => 200]);
    }
    return response()->json(['message' => 'Organisation not found.', 'status' => 404]);
}

// Backup organisation (could mean archiving or moving it to backup)
public function backupOrganisation($id)
{
    $organisation = Organisation::find($id);
    if ($organisation) {
        $organisation->archi = 0; // or some appropriate status
        $organisation->save();
        return response()->json(['message' => 'Organisation backed up successfully!', 'status' => 200]);
    }
    return response()->json(['message' => 'Organisation not found.', 'status' => 404]);
}

//deleting organisation
public function deleteOrganisation($id)
{
    $organisation = Organisation::find($id);
    if ($organisation) {
        $organisation->archive = 1; // or some appropriate status
        $organisation->save();
        return response()->json(['message' => 'Organisation deleted successfully!', 'status' => 200]);
    }
    return response()->json(['message' => 'Organisation not found.', 'status' => 404]);
}





// Actions on groups by admin
public function approveGroup($id)
{
    $group = Group::find($id);
    if ($group) {
        $group->status = 1;
        $group->save();
        return response()->json(['message' => 'group approved successfully!', 'status' => 200]);
    }
    return response()->json(['message' => 'group not found.', 'status' => 404]);
}

public function suspendGroup($id)
{
    $group = Group::find($id);
    if ($group) {
        $group->status = 0;
        $group->save();
        return response()->json(['message' => 'group suspended successfully!', 'status' => 200]);
    }
    return response()->json(['message' => 'group not found.', 'status' => 404]);
}

public function backupGroup($id)
{
    $group = Group::find($id);
    if ($group) {
        $group->archive = 0;
        $group->save();
        return response()->json(['message' => 'Group backed up successfully!', 'status' => 200]);
    }
    return response()->json(['message' => 'Group not found.', 'status' => 404]);
}

public function deleteGroup($id)
{
    $group = Group::find($id);
    if ($group) {
        $group->archive = 1;
        $group->save();
        return response()->json(['message' => 'group deleted successfully!', 'status' => 200]);
    }
    return response()->json(['message' => 'Group not found.', 'status' => 404]);
}

}
