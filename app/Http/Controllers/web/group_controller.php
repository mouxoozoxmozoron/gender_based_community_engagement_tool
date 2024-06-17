<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Group;
use App\Models\Group_Member;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class group_controller extends Controller
{
    public function group_detail(REQUEST $req)
    {
        $gid = $req->id;
        $group = Group::with('group_members.users', 'group_members.group.events', 'posts.comments.replies', 'posts.likes')->where('id', $gid)->first();
        $req->session()->put('user_groupname', $group);
        $eventcount = Event::count();
        $postcount = Post::count();
        $usercount = User::count();

        // return response()->json($group);
        return view('screens/management/home_dashboard', [
            'groupdata' => $group,
            'usercount' => $usercount,
            'postcount' => $postcount,
            'eventcount' => $eventcount,
        ]);
    }

    public function group_members(REQUEST $req)
    {
        $gid = $req->id;

        //new way
        // Step 1: Fetch Group and Group Members
        $group = Group::with('group_members')->where('id', $gid)->first();

        // Check if group is found
        if (!$group) {
            return response()->json(['error' => 'Group not found'], 404);
        }

        // Step 2: Extract User IDs from Group Members
        $userIds = $group->group_members->pluck('user_id');

        // Step 3: Fetch Users Associated with User IDs
        $users = User::whereIn('id', $userIds)->where('id', '!=', session('user_id'))->get();

        // Step 4: Combine the Data (if necessary)

        // new way

        $group = Group::with('group_members.users', 'group_members.group.events', 'posts.comments.replies', 'posts.likes')->where('id', $gid)->first();
        $req->session()->put('user_groupname', $group);
        // return response()->json($users);
        return view('screens/management/home_dashboard', [
            'groupdata' => $group,
            'groupusers' => $users,
        ]);
    }

    public function group_posts(REQUEST $req)
    {
        $gid = $req->id;
        $group = Group::with('group_members.users', 'group_members.group.events', 'posts.comments.replies', 'posts.likes')->where('id', $gid)->first();
        $req->session()->put('user_groupname', $group);
        // return response()->json($group);
        return view('screens/management/home_dashboard', ['groupdata' => $group]);
    }

    public function group_events(REQUEST $req)
    {
        $gid = $req->id;
        $group = Group::with('group_members.users', 'group_members.group.events', 'group_members.group.events.bookings', 'posts.comments.replies', 'posts.likes')->where('id', $gid)->first();
        $req->session()->put('user_groupname', $group);
        // return response()->json($group);
        return view('screens/management/home_dashboard', ['groupdata' => $group]);
    }

    public function deleteuser(REQUEST $req)
    {
        $userid = $req->id;

        $user = User::where('id', $userid)->first();
        if ($user) {
            $user->delete();
            return redirect()->back()->with('userdeletionsuccess', 'user deleted successfully');
        }
        return redirect()->back()->with('deletionerror', 'user not found');
    }

    public function deleteevent(REQUEST $req)
    {
        $evid = $req->id;

        $ev = Event::where('id', $evid)->first();
        if ($ev) {
            $ev->delete();
            return redirect()->back()->with('eventdeletionsuccess', 'event deleted successfully');
        }
        return redirect()->back()->with('eventdeletionerror', 'event not found');
    }

    public function deletepost(REQUEST $req)
    {
        $postid = $req->id;

        $pst = Event::where('id', $postid)->first();
        if ($pst) {
            $pst->delete();
            return redirect()->back()->with('postdeletionsuccess', 'post deleted successfully');
        }
        return redirect()->back()->with('postdeletionerror', 'post not found');
    }
}
