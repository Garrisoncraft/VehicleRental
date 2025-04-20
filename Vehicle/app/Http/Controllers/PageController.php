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

        // Here you can handle the contact form submission, e.g., send email or save to database
        // For simplicity, we'll just flash a success message

        // Example: Mail::to('admin@example.com')->send(new ContactFormMail($request->all()));

        return redirect()->route('home_page')->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
