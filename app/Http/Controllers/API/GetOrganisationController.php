<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Organisation;
use Illuminate\Http\Request;

class GetOrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $organisation = Organisation::where('archive', 0)
        ->where('status', 1)
        ->get();

        return response()->json([
            'organisations'=>$organisation
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
