<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactSubmissionConfirmation;
use App\Mail\ContactSubmissionNotification;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('pages.contact');
    }

    public function submit(ContactFormRequest $request)
    {
        $data = $request->validated();

        Mail::to('support@levelminds.in')->send(new ContactSubmissionNotification($data));
        Mail::to($data['email'])->send(new ContactSubmissionConfirmation($data));

        return redirect()->route('contact')->with('status', 'Thank you for reaching out. Our team will get back to you soon.');
    }
}
