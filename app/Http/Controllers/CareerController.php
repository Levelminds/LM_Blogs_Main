<?php

namespace App\Http\Controllers;

use App\Http\Requests\CareerApplicationRequest;
use App\Mail\CareerApplicationConfirmation;
use App\Mail\CareerApplicationNotification;
use Illuminate\Support\Facades\Mail;

class CareerController extends Controller
{
    public function show()
    {
        return view('pages.careers');
    }

    public function submit(CareerApplicationRequest $request)
    {
        $data = $request->validated();

        Mail::to('support@levelminds.in')->send(new CareerApplicationNotification($data));
        Mail::to($data['email'])->send(new CareerApplicationConfirmation($data));

        return redirect()->route('careers')->with('status', 'Application received! We will connect with you shortly.');
    }
}
