<?php

namespace App\Http\Controllers\API\event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\event_creation_request;
use App\Models\Event;
use App\Models\Group;
use App\Traits\FileTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    use FileTrait;
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
    public function store(event_creation_request $request)
    {
        try {
            DB::beginTransaction();
            $eventData = $request->validated();

            // Store the profile photo
            $image_string = $eventData['image'];
            $image_url = $this->storeBase64File($image_string, 'Files/image_events');

            //get group id the event belongs to
            $group_admin_id = Auth::user()->id;
            $group_id = $eventData['group_id'];
            $group = Group::where('id', $group_id )->first();
            if (!$group) {
                return response()->json(['error' => 'only group admins can create and share events'], 401);
            }
            $group_id = $eventData['group_id'];
            $group_name = $group->name;
            $eventData['image'] = $image_url;
            $eventData['user_id'] = Auth::user()->id;
            $eventData['group_id'] = $group_id;

            // Create the event
            $event = Event::create($eventData);
            DB::commit();
            // Return success response

            return response()->json(
                [
                    'message' => 'you shared an event with ' . $group_name . ' group',
                ],
                201,
            );
        } catch (Exception $e) {
            // Handle any exceptions
            DB::rollback();
            Log::error('Error occurred during event createion: ' . $e->getMessage());
            return response()->json(['error' => 'event creation failed.', 'message' => $e->getMessage()], 500);
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
