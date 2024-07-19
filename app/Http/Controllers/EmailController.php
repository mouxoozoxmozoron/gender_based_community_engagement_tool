<?php

namespace App\Http\Controllers;

use App\Mail\mail_notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $data = [
            'subject' => 'gbce sharing notification',
            'body' => 'Your friends say, gbce is a better tool for enhancing inclusive development. Try it for a better inclusive future. Click <a href="http://192.168.1.5:8000"></a> to visit gbce.',
        ];

        try {
            $email = $request->input('email');

            $emailsent = Mail::mailer()->to($email)->send(new mail_notify($data));
            if ($emailsent) {
                return redirect()->back()->with('emailsentsuccess', 'Email sent successfully!');
            } else {
                return redirect()->back()->with('emailsendfailure', 'we are un able to process this request');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('emailsendfailure', $e->getMessage());
        }
    }
}
