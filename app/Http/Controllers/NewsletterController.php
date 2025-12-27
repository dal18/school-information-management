<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Subscribe to newsletter
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'name' => 'nullable|string|max:255',
        ]);

        // Check if email is already subscribed
        $existingSubscriber = NewsletterSubscriber::where('email', $request->email)->first();

        if ($existingSubscriber) {
            if ($existingSubscriber->status === 'active') {
                return back()->with('error', 'This email is already subscribed to our newsletter.');
            } else {
                // Resubscribe if previously unsubscribed
                $existingSubscriber->resubscribe();
                return back()->with('success', 'Welcome back! You have been resubscribed to our newsletter.');
            }
        }

        // Create new subscriber
        NewsletterSubscriber::create([
            'email' => $request->email,
            'name' => $request->name,
            'status' => 'active',
            'ip_address' => $request->ip(),
            'subscribed_at' => now(),
        ]);

        return back()->with('success', 'Thank you for subscribing! You will receive updates from Little Flower High School.');
    }

    /**
     * Unsubscribe from newsletter
     */
    public function unsubscribe(Request $request, $id)
    {
        $subscriber = NewsletterSubscriber::findOrFail($id);
        $subscriber->unsubscribe();

        return redirect()->route('home')->with('success', 'You have been unsubscribed from our newsletter.');
    }
}
