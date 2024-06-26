<?php

namespace App\Http\Controllers\API\event;

use App\Http\Controllers\Controller;
use App\Models\Feedbac;
use App\Traits\DocumentTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FeedbacController extends Controller
{
    use DocumentTrait;

    // use FileTrait;

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
            $newfeedback = new Feedbac();

            $report = $request->report;
            $uid = Auth::user()->id;
            $event_id = $request->event_id;

            // Store the  documents
            $report_string = $report;
            $report_url = $this->storeBase64File($report_string, 'Files/event_reports');
            // $report_url = $this->storeBase64File($report_string, 'Files/event_reports');
            // return response()->json($report_url, 200);



            $newfeedback->user_id = $uid;
            $newfeedback->event_id = $event_id;
            $newfeedback->report = $report_url;

            $createdfeedback = $newfeedback->save();
            if ($createdfeedback) {
                DB::commit();
                return response()->json('feedback sent succesfully', 201);
            } else {
                DB::rollBack();
                return response()->json('we could not process your request, try again after a while ', 401);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'error' => $e->getMessage(),
                    'message' => 'something went wrong during processing your request',
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
