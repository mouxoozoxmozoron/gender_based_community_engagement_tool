<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Insight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class insight_controller extends Controller
{
    public function saveuserinsight(REQUEST $req)
    {
        try {
            DB::beginTransaction();
            $insight = new Insight();
            $insight->name = $req->name;
            $insight->email = $req->email;
            $insight->subject = $req->subject;
            $insight->message = $req->message;

            $savedinsight = $insight->save();
            if ($savedinsight) {
                DB::commit();
                // return response()->json(['success' => true, 'redirect' => back()->getTargetUrl()]);
                return redirect()->back()->with('insightsaved', "Insight has been sent");
            }
            DB::rollBack();
            return redirect()->back()->with('error', 'We are unable to process your request');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
