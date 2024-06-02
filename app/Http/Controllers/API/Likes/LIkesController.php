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
        try {
            DB::beginTransaction();
            $request->validate([
                'post_id' => 'required',
            ]);

            $existingLike = Like::where('post_id', $request->post_id)
                ->where('user_id', Auth::id())
                ->first();


            if ($existingLike) {
                $existingLike->delete();
                DB::commit();
                return response()->json(['message' => 'Unliked'], 200);
            }

            $newLike = [
                'post_id' => $request->post_id,
                'user_id' => Auth::id(),
            ];

            $createdLike = Like::create($newLike);

            if ($createdLike) {
                DB::commit();
                return response()->json(['message' => 'Liked'], 201);
            }

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
