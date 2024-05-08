<?php

namespace App\Http\Controllers\API\Likes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LIkesController extends Controller
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
        // Validate the incoming request data
        try {
            //code...
            DB::beginTransaction();
            $request->validate([
                'post_id' => 'required',
            ]);

            // Find an existing like for the same post and user
            $existingLike = Like::where('post_id', $request->post_id)
                ->where('user_id', Auth::id())
                ->first();

            // If an existing like is found, delete it and return response
            if ($existingLike) {
                $existingLike->delete();
                DB::commit();
                return response()->json(['message' => 'Unliked'], 200);
            }

            // If no existing like is found, create a new like
            $newLike = [
                'post_id' => $request->post_id,
                'user_id' => Auth::id(),
            ];

            // Create the new like
            $createdLike = Like::create($newLike);

            // Check if the like was created successfully
            if ($createdLike) {
                DB::commit();
                return response()->json(['message' => 'Liked'], 201);
            }

            // If something went wrong during like creation
            DB::rollBack();
            return response()->json(['message' => 'Failed to set like'], 500);
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            return response()->json(
                [
                    'error' => $e->getMessage(),
                    'message' => 'an error occured during processing your request',
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
