<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Group;
use App\Models\Insight;
use App\Models\Organisation;
use App\Models\OrganisationAdmin;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $organisation->archive = 1;
        $organisation->save();
        return response()->json(['message' => 'Organisation deleted successfully!', 'status' => 200]);
    }
    return response()->json(['message' => 'Organisation not found.', 'status' => 404]);
}


//removing organisation admin
public function FreezeAdminFromOrganisation($id)
{
    DB::beginTransaction();

    try {
        $organisation = Organisation::find($id);

        if (!$organisation) {
            return response()->json(['message' => 'Organisation not found.', 'status' => 404]);
        }

        $organisationadmin = OrganisationAdmin::where('user_id', $organisation->org_admin_id)->first();

        if (!$organisationadmin) {
            return response()->json(['message' => 'Organisation admin not found.', 'status' => 404]);
        }

        $organisationadmin->archive = 1;
        $organisationadmin->status = 1;
        $organisation->org_admin_id = null;

        $organisationadmin->save();
        $organisation->save();

        DB::commit();

        return response()->json(['message' => 'Organisation admin removed successfully!', 'status' => 200]);

    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'message' => 'An error occurred, try again later ',
            // 'message' => 'An error occurred: ' . $e->getMessage(),
            'status' => 500
        ]);
    }
}




// Actions on groups by admin
public function approveGroup($id)
{
    $group = Group::find($id);
    if ($group) {
        $group->status = 1;
        $group ->aproved_by =  Auth::user()->id;
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

public function deleteEveent($id)
{
    $event = Event::find($id);
    if ($event) {
        $event->archive = 1;
        $event->save();
        return response()->json(['message' => 'Event deleted successfully!', 'status' => 200]);
    }
    return response()->json(['message' => 'event not found.', 'status' => 404]);
}


public function AllOrgPosts($id){
    $posts = Post::with('user')->where('group_id', $id)
    ->where('archive', 0)
    ->get();
    // return response()->json($posts);
    return view('screens.management.systemAdmin.view_group_post', compact('posts'));
}


public function AllorgEvent($id){
    $events = Event::with('user', 'bookings')->where('group_id', $id)
    ->where('archive', 0)
    ->get();
    // return response()->json('here from organisation event');
    return view('screens.management.systemAdmin.view_group_event', compact('events'));
}


public function assignAdmin(Request $request)
{
    DB::beginTransaction();

    try {
        $organisationId = $request->input('organisation_id');
        $userId = $request->input('user_id');

        $organisation = Organisation::findOrFail($organisationId);
        $user = User::findOrFail($userId);

        if ($organisation->org_admin_id) {
            return response()->json(['message' => 'This organisation already has an admin assigned.', 'status' => 400]);
        }

        $organisationAdmin = new OrganisationAdmin();
        $organisationAdmin->organisation_id = $organisationId;
        $organisationAdmin->user_id = $userId;
        $organisationAdmin->position = 1;
        $organisationAdmin->status = 1;

        $organisation->org_admin_id = $userId;
        $organisation->status = 1;
        $organisation->aproved_by = Auth::user()->id;

        $user->user_type = 4;

        $organisationAdmin->save();
        $organisation->save();
        $user->save();

        DB::commit();

        return response()->json(['message' => 'Admin assigned successfully!', 'status' => 200]);

    } catch (\Exception $e) {
        // Rollback the transaction
        DB::rollBack();

        // Get the exact exception message
        $error = $e->getMessage();

        // Optionally, you can still log the error for debugging
        // \Log::error('Error assigning admin to organisation: ' . $error);

        // Return the error message in the JSON response
        return response()->json([
            'message' => "An error occurred: $error",
            'status' => 500
        ]);
    }
}


public function systemadmnDashView()
{
    // Fetch data (optional, if needed)
    $events = Event::with('user', 'group', 'bookings')->where('archive', 0)->get();
    $posts = Post::with('user','comments', 'group', 'likes' )->where('archive', 0)->get();
    $uCount = User::where('archive', 0)->where('user_type', '!=', 1)->count();
    $groupCount = Group::where('archive', 0)->count();
    $organisationCount = Organisation::where('archive', 0)->count();
    $insightCount = Insight::where('archive', 0)->count();



    $acountsCount = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
    ->groupBy('month')
    ->orderBy('month')
    ->get();

        // Prepare data for the chart
        $months = [];
        $counts = [];

        foreach ($acountsCount as $userCount) {
            $months[] = Carbon::parse($userCount->month)->format('F Y');
            $counts[] = $userCount->count;
        }



        //posts and event trends
    $year = Carbon::now()->year;

    // Fetch posts grouped by month and count
    $poststrend = Post::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->whereYear('created_at', $year)
        ->groupBy('month')
        ->pluck('count', 'month');

    // Fetch events grouped by month and count
    $eventstrend = Event::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->whereYear('created_at', $year)
        ->groupBy('month')
        ->pluck('count', 'month');

    // Prepare months labels (1 to 12)
    $monthstre = [];
    $postCounts = [];
    $eventCounts = [];

    for ($i = 1; $i <= 12; $i++) {
        // Format month name
        $monthstre[] = Carbon::createFromDate($year, $i, 1)->format('F');

        // Get counts or default to 0 if no posts/events
        $postCounts[] = $poststrend->get($i, 0);
        $eventCounts[] = $eventstrend->get($i, 0);
    }




    // Return the view (or HTML) that will be injected
    return view('screens.management.systemAdmin.views.userview', compact([
        'events',
        'posts',
        'uCount',
        'groupCount',
        'organisationCount',
        'insightCount',
        'months',
        'counts',
        'postCounts',
        'eventCounts',
        'monthstre'
    ]));
}

}
