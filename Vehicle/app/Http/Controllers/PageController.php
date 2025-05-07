<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function about()
    {
        return view('about');
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $emailContent = "Name: " . $request->input('name') . "\n" .
                        "Email: " . $request->input('email') . "\n" .
                        "Message: " . $request->input('message');

        Mail::raw($emailContent, function ($message) use ($request) {
            $message->to('garrisonsayor@gmail.com')
                    ->subject('New Contact Form Submission');
        });

        return redirect()->route('home_page')->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
