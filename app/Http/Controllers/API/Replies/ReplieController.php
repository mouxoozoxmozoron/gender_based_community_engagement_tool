<?php

namespace App\Http\Controllers\API\Replies;

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

class ReplieController extends Controller
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
            $NewReplie = $request->validate([
                'message' => 'string|required',
                'comment_id' => 'required',
            ]);
            $NewReplie['user_id'] = Auth::User()->id;
            $replieSet = Replie::create($NewReplie);

            if ($replieSet) {
                DB::commit();
                return response()->json('Replie set succesfull', 201);
            } else {
                DB::rollback();
                return response()->json(['message' => 'Something went wrong'], 404);
            }
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            return response()->json(
                [
                    'error' => $e->getMessage(),
                    'message' => 'there was an erro when trying to store your replie',
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
            //code...
            DB::beginTransaction();
            $ReplieDelete = Replie::findOrFail($id);
            $Deleted = $ReplieDelete->delete();

            if ($Deleted) {
                DB::commit();
                return response()->json(['message' => 'Replie deleted succesfull'], 200);
            } else {
                DB::rollBack();
                return response()->json(['message' => 'something went wrong'], 404);
            }
        } catch (\Exception $e) {
            //throw $th;
            DB::rollBack();
            return response()->json(
                [
                    'error' => $e->getMessage(),
                    'message' => 'there was an error when trying to delete your information',
                ],
                500,
            );
        }

        //
    }
}
