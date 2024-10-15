<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Group;
use App\Models\Group_Member;
use App\Models\Organisation;
use App\Models\OrganisationAdmin;
use App\Models\Post;
use App\Models\User;
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
