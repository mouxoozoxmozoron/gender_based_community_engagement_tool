<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class user_controller extends Controller
{
    public function login_check(REQUEST $req)
    {
        try {
            $user = User::where('email', $req->input('email'))->first();
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Incorrect email or password']);
            } else {
                if ($user && Hash::check($req->input('password'), $user->password)) {
                    $group = Group::where('admin_id', $user->id)->get();
                    $req->session()->put('user_groups', $group);
                    $req->session()->put('user_id', $user->id);
                    $req->session()->put('user_object', $user);
                    return response()->json(['success' => true, 'redirect' => url('/')]);
                } else {
                    return response()->json(['success' => false, 'message' => 'Incorrect email or password']);
                }
            }
        } catch (\Exception $e) {
            //throw $th;
            return response()->json(
                [
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }

    public function registration_check()
    {
        return response()->json('here from login page');
    }
}
