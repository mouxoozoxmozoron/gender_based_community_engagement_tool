<?php

namespace App\Http\Controllers\API\booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Event;
use App\Models\Group;
use App\Traits\TicketGeneratorTrait;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class booking_controller extends Controller
{
    use TicketGeneratorTrait;
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
            // Start a database transaction
            DB::beginTransaction();

            // Create a new booking instance
            $booking = new Booking();

            // Fetch event details
            $event_id = $request->input('event_id');
            $event_details = Event::findOrFail($event_id);
            $group_id = $event_details->group_id;
            //group details
            $group_details = Group::findOrFail($group_id);
            $group_name = $group_details->name;

            // public/storage/Files/app_logo/gbce_logo.png
            $date = $event_details->date;
            $time = $event_details->time;
            $location = $event_details->location;
            $event_title = $event_details->title;

            // Fetch user details
            $userName = Auth::user()->first_name;
            $user_email = Auth::user()->email;
            $last_name = Auth::user()->last_name;
            $user_name = $userName . ' ' . $last_name;

            // Generate a ticket token
            $ticket_token = $this->generateTicketToken($userName);

            // Data for the PDF
            $data = [
                [
                    'title' => $event_title,
                    'description' => 'keep safe this ticket for privacy',
                    'token' => $ticket_token,
                    'location' => $location,
                    'date' => $date,
                    'time' => $time,
                    'user_name' => $user_name,
                    'user_email' => $user_email,
                    'group_name' => $group_name,
                ],
            ];

            // Load the view and generate the PDF
            $pdf = PDF::loadView('pdf', ['data' => $data]);

            // Save the booking details
            $booking->user_id = Auth::user()->id;
            $booking->event_id = $event_id;
            $booking->token = $ticket_token;
            $booking->save();

            // Commit the database transaction
            DB::commit();

            // Download the PDF, you can stream() instead of downloading the pdf
            return $pdf->download($user_name . 'event_ticket_' . '.pdf');
        } catch (\Exception $e) {
            // Roll back the database transaction in case of an error
            DB::rollback();

            // Return error response//
            return response()->json(
                [
                    'error' => 'Something went wrong during ticket generation',
                    'message' => $e->getMessage(),
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
