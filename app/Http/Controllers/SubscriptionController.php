<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionConfirmationMail;

class SubscriptionController extends Controller
{
    // Store new or existing subscription
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $subscription = Subscription::firstOrNew(['email' => $data['email']]);

        $subscription->categories = $data['categories'] ?? $subscription->categories ?? [];
        $subscription->category_id = $data['category_id'] ?? $subscription->category_id;

        $needsConfirmation = ! $subscription->exists || ! $subscription->confirmed;

        if ($needsConfirmation) {
            $subscription->confirmation_token = Str::random(32);
            $subscription->confirmed = false;
        }

        $subscription->save();

        if ($needsConfirmation) {
            Mail::to($subscription->email)->send(new SubscriptionConfirmationMail($subscription));
        }

        $message = $subscription->confirmed
            ? 'Your subscription preferences have been updated.'
            : 'Please check your email to confirm your subscription.';

        return back()->with('success', $message);
    }

    // Confirm subscription from email
    public function confirm($token)
    {
        $subscription = Subscription::where('confirmation_token', $token)->firstOrFail();

        $subscription->update([
            'confirmed' => true,
            'confirmation_token' => null
        ]);

        return redirect('/blog')->with('success', 'Your subscription is confirmed!');
    }
}
