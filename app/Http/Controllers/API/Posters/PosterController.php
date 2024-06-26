<?php

namespace App\Http\Controllers\API\Posters;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Replie;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PosterController extends Controller
{
    use FileTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return response()->json($posts, 200);
        // return response()->json([$posts], 200);
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

        $post = $request->validate([
            'title' => 'string|Required',
            'description' => 'string|Required',
            'post_image' => 'nullable',
            'group_id' => 'nullable',
        ]);

        $image_string = $request->input('post_image');
        $PostImage_url = $this->storeBase64File($image_string, 'Files/PosterIMages');


        $post['user_id'] = Auth::user()->id;
        $post['post_image'] = $PostImage_url;
        $post['post_type'] = 1;
        Post::create($post);

        return response()->json(['message' => 'Post Created Successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            //code...
            $post = Post::find($id); // Retrieve a post by its ID

            if ($post) {
                return response()->json($post, 200); // Return the post if found
            } else {
                return response()->json(['message' => 'Post not found'], 404); // Return a 404 response if the post is not found
            }
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(
                [
                    'error' => $e->getMessage(),
                    'message' => 'there was an error during fetching post',
                ],
                500,
            );
        }
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
        try {
            DB::beginTransaction();
            // Validate the data from request
            $post = $request->validate([
                'title' => 'string|required',
                'description' => 'string|required',
                'post_image' => 'nullable', // No need for validation if it's nullable
                'post_type' => 'integer|required',
            ]);

            $oldPostData = Post::findOrFail($id);

            // Checking if the request contains a cover image
            if ($request->has('post_image') && $request->post_image !== null) { // Check if post_image exists and is not null
                // Get the file string from request
                $image_string = $request->input('post_image');
                // Decoding the image string and storing it to the storage
                $PostImage_url = $this->storeBase64File($image_string, 'Files/PosterImages');

                // Modifying the cover image url
                $post['post_image'] = $PostImage_url;

                // Delete the old cover image
                $this->deleteFileFromStorage($oldPostData->post_image);
            } elseif ($request->post_image === null) {
                // If the post_image is null, remove it from the $post array
                unset($post['post_image']);
            }

            // Updating the post
            $postUpdated = Post::where('id', $id)->update($post);

            if ($postUpdated) {
                DB::commit();
                return response()->json(['message' => 'Post Updated Successfully'], 200);
            }
            DB::rollBack();
            return response()->json(['message' => 'Something went wrong'], 400);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Something went wrong in PostController.update',
                'message' => $e->getMessage(),
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            DB::beginTransaction();
            // Find the post to delete
            $postToDelete = Post::findOrFail($id);
            $postId = $postToDelete->id;

            // Find all comments associated with the post
            $commentsToDelete = Comment::where('post_id', $postId)->get();

            // Delete each comment and its associated replies
            foreach ($commentsToDelete as $comment) {
                $commentId = $comment->id;

                // Find all replies associated with the comment
                $repliesToDelete = Replie::where('comment_id', $commentId)->get();

                // Delete each reply
                foreach ($repliesToDelete as $reply) {
                    $reply->delete();
                }

                // Delete the comment
                $comment->delete();
            }

            // Delete the post's image from storage
            $this->deleteFileFromStorage($postToDelete->post_image);

            // Finally, delete the post
            $postToDelete->delete();
            DB::commit();
            return response()->json(['message' => 'Post and associated comments, replies, and image deleted successfully'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Something went wrong: ' . $e->getMessage()], 500);
        }
    }
}
