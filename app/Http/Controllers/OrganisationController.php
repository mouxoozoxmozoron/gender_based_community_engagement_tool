<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Group;
use App\Models\Group_Member;
use App\Models\Insight;
use App\Models\Organisation;
use App\Models\OrganisationAdmin;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrganisationController extends Controller
{
    public function Dashboard()
    {
        // return response()->json($group);
        return view('screens/management/home_dashboard', [
            'groupdata' => '',
            'usercount' => '',
            'postcount' => '',
            'eventcount' => '',
        ]);
    }


    public function organisationAdminDashboardView()
{
    $authUserId = Auth::id();

    // Fetch organisation IDs where the authenticated user is an admin
    $organisationIds = OrganisationAdmin::where('user_id', $authUserId)
                                        ->where('archive', 0)
                                        ->pluck('organisation_id');

    // Fetch organisations and their groups where the user is an admin
    $organisationData = Organisation::with('groups')
                                    ->where('archive', 0)
                                    ->whereIn('id', $organisationIds)
                                    ->get();

    // Extract group IDs from the fetched organisations safely
    $groupIds = $organisationData->pluck('groups.*.id')->flatten()->filter()->toArray();

    // Fetch events where group_id is in the extracted group IDs
    $events = Event::with('user', 'group', 'bookings')
                   ->where('archive', 0)
                   ->whereIn('group_id', $groupIds)
                   ->get();

    // Fetch posts where group_id is in the extracted group IDs
    $posts = Post::with('user', 'comments', 'group', 'likes')
                 ->where('archive', 0)
                 ->whereIn('group_id', $groupIds)
                 ->get();

    // Other counts
    $uCount = Group_Member::
            where('archive', 0)
            ->whereIn('group_id', $groupIds)
            ->count();
    $groupCount = Group::
            where('archive', 0)
            ->whereIn('organisation_id', $organisationIds)
            ->count();
    $organisationCount = Organisation::
            where('archive', 0)
            ->whereIn('id', $organisationIds)
            ->count();
    $insightCount = Insight::where('archive', 0)->count();

    // Monthly group member joining  counts
    $acountsCount = Group_Member::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
                        ->groupBy('month')
                        ->orderBy('month')
                        ->whereIn('group_id', $groupIds)
                        ->get();

    // Prepare data for the user growth chart
    $months = [];
    $counts = [];
    foreach ($acountsCount as $userCount) {
        $months[] = Carbon::parse($userCount->month)->format('F Y');
        $counts[] = $userCount->count;
    }

    // Post and event trends for the current year
    $year = Carbon::now()->year;

    // Fetch posts and events trends grouped by month
    $poststrend = Post::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                      ->whereYear('created_at', $year)
                      ->whereIn('group_id', $groupIds)
                      ->groupBy('month')
                      ->pluck('count', 'month');
    $eventstrend = Event::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                        ->whereYear('created_at', $year)
                        ->whereIn('group_id', $groupIds)
                        ->groupBy('month')
                        ->pluck('count', 'month');

    // Prepare data for post and event trends
    $monthstre = [];
    $postCounts = [];
    $eventCounts = [];
    for ($i = 1; $i <= 12; $i++) {
        $monthstre[] = Carbon::createFromDate($year, $i, 1)->format('F');
        $postCounts[] = $poststrend->get($i, 0); // Default to 0 if no post count
        $eventCounts[] = $eventstrend->get($i, 0); // Default to 0 if no event count
    }

    // Return the JSON response
    // return response()->json([
    //     'events' => $events,
    //     'posts' => $posts,
    //     'uCount' => $uCount,
    //     'groupCount' => $groupCount,
    //     'organisationCount' => $organisationCount,
    //     'insightCount' => $insightCount,
    //     'months' => $months,
    //     'counts' => $counts,
    //     'postCounts' => $postCounts,
    //     'eventCounts' => $eventCounts,
    //     'monthstre' => $monthstre
    // ]);

    return view('screens.management.OrganisationAdmin.views.view_dash', compact([
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

    public function AllOrganisation()
    {
        $organisations = Organisation::where('archive', 0)
            ->whereHas('admins', function ($query) {
                $query->where('user_id', Auth::id())->where('status', 1)->where('archive', 0);
            })
            ->get();

        return view('screens.management.OrganisationAdmin.organisation_list', compact('organisations'));
    }

    public function AsignAsistantAdmin(Request $request)
    {
        DB::beginTransaction();

        try {
            $organisationId = $request->input('organisation_id');
            $userId = $request->input('user_id');

            $organisation = Organisation::findOrFail($organisationId);
            $user = User::findOrFail($userId);

            $organisationAdmin = new OrganisationAdmin();
            $organisationAdmin->organisation_id = $organisationId;
            $organisationAdmin->user_id = $userId;
            $organisationAdmin->position = 2;
            $organisationAdmin->status = 1;

            $user->user_type = 4;

            $organisationAdmin->save();
            $user->save();

            DB::commit();

            return response()->json(['message' => 'Asistant Admin assigned successfully!', 'status' => 200]);
        } catch (\Exception $e) {
            DB::rollBack();

            $error = $e->getMessage();

            // Optionally, you can still log the error for debugging
            // \Log::error('Error assigning admin to organisation: ' . $error);

            // Return the error message in the JSON response
            return response()->json([
                'message' => "An error occurred: $error",
                'status' => 500,
            ]);
        }
    }

    public function AllOrgGroups($id)
    {
        $groups = Group::with('user')->where('archive', 0)->where('organisation_id', $id)->get();
        // return response()->json($groups);
        return view('screens.management.OrganisationAdmin.org_groups', compact('groups'));
    }

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

    public function OrganisationPosts($id)
    {
        $posts = Post::with('user')->where('group_id', $id)->where('archive', 0)->get();
        // return response()->json($posts);
        return view('screens.management.OrganisationAdmin.organisation_post', compact('posts'));
    }

    public function OrganisationEvents($id)
    {
        $events = Event::with('user', 'bookings')->where('group_id', $id)->where('archive', 0)->get();
        // return response()->json('here from organisation event');
        return view('screens.management.OrganisationAdmin.organisation_event', compact('events'));
    }

    public function GroupMembers($id)
    {
        $members = Group_Member::with('users')->where('group_id', $id)->where('archive', 0)->get();
        // return response()->json($members);
        return view('screens.management.OrganisationAdmin.group_members', compact('members'));
    }

    public function deleteMmeber($id)
    {
        $member = Group_Member::find($id);
        if ($member) {
            $member->archive = 1;
            $member->save();
            return response()->json(['message' => 'Group member deleted successfully!', 'status' => 200]);
        }
        return response()->json(['message' => 'Group not found.', 'status' => 404]);
    }

    public function suspendMmeber($id)
    {
        $member = Group_Member::find($id);
        if ($member) {
            $member->status = 0;
            $member->save();
            return response()->json(['message' => 'Member suspended successfully!', 'status' => 200]);
        }
        return response()->json(['message' => 'member not found.', 'status' => 404]);
    }

    public function activateMmember($id)
    {
        $member = Group_Member::find($id);
        if ($member) {
            $member->status = 1;
            $member->save();
            return response()->json(['message' => 'Member activated successfully!', 'status' => 200]);
        }
        return response()->json(['message' => 'member not found.', 'status' => 404]);
    }

    public function organisationlist()
    {
        $organisations = Organisation::where('archive', 0)
            ->whereHas('admins', function ($query) {
                $query->where('user_id', Auth::id())->where('status', 1)->where('archive', 0);
            })
            ->get();

        return view('screens.management.OrganisationAdmin.report_org', compact('organisations'));
    }

    public function OrganisationReport($id)
    {
        return response()->json('here from organisation general report controller');
    }
}
