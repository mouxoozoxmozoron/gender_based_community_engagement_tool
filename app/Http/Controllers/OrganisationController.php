<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
