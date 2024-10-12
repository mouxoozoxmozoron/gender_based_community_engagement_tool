<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\OrganisationAdmin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrganisationController extends Controller
{
    public function Dashboard(){

        // return response()->json($group);
        return view('screens/management/home_dashboard', [
            'groupdata' => '',
            'usercount' => '',
            'postcount' => '',
            'eventcount' => '',
        ]);
    }

    public function AllOrganisation(){
        $organisations = Organisation::where('archive', 0)
        ->whereHas('admins', function($query) {
            $query->where('user_id', Auth::id())
                  ->where('status', 1)
                  ->where('archive', 0);
        })
        ->get();

        return view('screens.management.OrganisationAdmin.organisation_list', compact('organisations'));
    }

    public function AsignAsistantAdmin(Request $request){
        DB::beginTransaction();

        try {
            $organisationId = $request->input('organisation_id');
            $userId = $request->input('user_id');

            $organisation = Organisation::findOrFail($organisationId);
            $user = User::findOrFail($userId);

            $organisationAdmin = new OrganisationAdmin();
            $organisationAdmin->organisation_id = $organisationId;
            $organisationAdmin->user_id = $userId;
            $organisationAdmin->position = 2;
            $organisationAdmin->status = 1;


            $user->user_type = 4;

            $organisationAdmin->save();
            $user->save();

            DB::commit();

            return response()->json(['message' => 'Asistant Admin assigned successfully!', 'status' => 200]);

        } catch (\Exception $e) {
            DB::rollBack();

            $error = $e->getMessage();

            // Optionally, you can still log the error for debugging
            // \Log::error('Error assigning admin to organisation: ' . $error);

            // Return the error message in the JSON response
            return response()->json([
                'message' => "An error occurred: $error",
                'status' => 500
            ]);
        }
    }
}
