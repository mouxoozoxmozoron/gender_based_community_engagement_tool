<?php

namespace App\Http\Controllers\API\Comments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Models\Replie;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
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
    public function store(Request $request)
    {
        try {
            //code...
            DB::beginTransaction();
            $newComment = $request->validate([
                'message' => 'string|required',
                'post_id' => 'required',
            ]);

            // Create new comment for a post
            $newComment['user_id'] = Auth::user()->id;
            $createdComment = Comment::create($newComment);

            if ($createdComment) {
                DB::commit();
                return response()->json('Comment set successfully', 201);
            } else {
                DB::rollBack();
                return response()->json(['message' => 'Something went wrong'], 404);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'error' => $e->getMessage(),
                    'message' => 'there was an error when trying to store your comment',
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
        try {
            DB::beginTransaction();
            // Find the comment to delete
            $commentToDelete = Comment::findOrFail($id);
            $commentId = $commentToDelete->id;

            // Find all replies associated with the comment
            $repliesToDelete = Replie::where('comment_id', $commentId)->get();

            // Delete the comment
            $commentDeleted = $commentToDelete->delete();

            // Delete all associated replies
            foreach ($repliesToDelete as $reply) {
                $reply->delete();
            }

            // Check if both comment and replies were successfully deleted
            if ($commentDeleted) {
                DB::commit();
                return response()->json(['message' => 'Comment and associated replies deleted successfully'], 200);
            } else {
                DB::rollback();
                return response()->json(['message' => 'Failed to delete comment'], 500);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }
}
