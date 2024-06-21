<?php

namespace App\Http\Controllers;

use App\Mail\mail_notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class email_controller extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $data=[
            'subject'=>"gbce sharing notification",
            'body'=>'someone says, gbce is a better tool for enhancing inclussie development',
        ];
        try {

            $email = $request->input('email');

            // Mail::raw('Hello from GBC, we are here for you', function ($message) use ($email) {
            //     $message->to($email)->subject('Hello from GBC');
            // });
            // Mail::to($email)->send(new mail_notify($data));
            Mail::mailer('smtp')->to($email)->send(new mail_notify($data));


            return redirect()->back()->with('success', 'Email sent successfully!');
        } catch (\Exception $e) {
            // return redirect()->back()->with('failure', 'Email not sent!');
            $error = $e->getMessage();
            return response()->json(
                [
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }
}
