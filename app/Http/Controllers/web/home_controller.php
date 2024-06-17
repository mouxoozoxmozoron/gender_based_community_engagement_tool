<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Group;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class home_controller extends Controller
{
    public function web_home()
    {
        $groupCount = Group::count();
        $userCount = User::count();
        $eventCount = Event::count();
        $postCount = Post::count();

        return view('welcome', [
            'userCount' => $userCount,
            'groupCount' => $groupCount,
            'postCount' => $postCount,
            'eventCount' => $eventCount,
        ]);
    }
}
