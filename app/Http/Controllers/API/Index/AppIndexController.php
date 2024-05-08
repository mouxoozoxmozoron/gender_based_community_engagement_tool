<?php

namespace App\Http\Controllers\API\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Replie;

class AppIndexController extends Controller
{
    //        $announc_list=announcement::join('users', 'announcements.created_by', '=', 'users.id' )->get();

    public function HomeContent()
    {
        try {
            //code...
            $posts = Post::with('user.user_type', 'comments.replies', 'likes')->get();
            if ($posts->isEmpty()) {
                # code...
                return response()->json(
                    [
                        'message' => 'no post found!',
                    ],
                    404,
                );
            }
            return response()->json(
                [
                    'message' => 'posts available',
                    'Posts' => $posts,
                ],
                200,
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'error' => $e->getMessage(),
                    'message' => 'an error occured during request processing',
                ],
                500,
            );
        }
    }

    //function for returning particular user profile
    public function Profiles(Request $request, $id)
    {
        try {
            //code...
            $user = User::with('user_type')->where('id', $id)->first();
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
            return response()->json(['user' => $user], 200);
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(
                [
                    'error' => $e->getMessage(),
                    'message' => 'error occured on processing your request',
                ],
                500,
            );
        }
    }
}
