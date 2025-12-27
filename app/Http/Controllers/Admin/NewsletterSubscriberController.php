<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterSubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = NewsletterSubscriber::query();

        // Filter by status
        if ($request->has('status') && $request->status) {
            if ($request->status === 'active') {
                $query->active();
            } elseif ($request->status === 'unsubscribed') {
                $query->unsubscribed();
            }
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('email', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%");
            });
        }

        $subscribers = $query->recent()->paginate(20)->withQueryString();

        // Statistics
        $stats = [
            'total' => NewsletterSubscriber::count(),
            'active' => NewsletterSubscriber::active()->count(),
            'unsubscribed' => NewsletterSubscriber::unsubscribed()->count(),
        ];

        return view('admin.newsletter-subscribers.index', compact('subscribers', 'stats'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subscriber = NewsletterSubscriber::findOrFail($id);
        $subscriber->delete();

        return redirect()->route('admin.newsletter-subscribers.index')
            ->with('success', 'Subscriber deleted successfully.');
    }

    /**
     * Bulk delete subscribers
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:newsletter_subscribers,id',
        ]);

        NewsletterSubscriber::whereIn('id', $request->ids)->delete();

        return redirect()->route('admin.newsletter-subscribers.index')
            ->with('success', count($request->ids) . ' subscriber(s) deleted successfully.');
    }

    /**
     * Export subscribers
     */
    public function export(Request $request)
    {
        $query = NewsletterSubscriber::active();

        if ($request->has('all') && $request->all == 'true') {
            $query = NewsletterSubscriber::query();
        }

        $subscribers = $query->recent()->get();

        $filename = 'newsletter_subscribers_' . date('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($subscribers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Email', 'Name', 'Status', 'Subscribed At', 'IP Address']);

            foreach ($subscribers as $subscriber) {
                fputcsv($file, [
                    $subscriber->id,
                    $subscriber->email,
                    $subscriber->name ?? 'N/A',
                    $subscriber->status,
                    $subscriber->subscribed_at ? $subscriber->subscribed_at->format('Y-m-d H:i:s') : 'N/A',
                    $subscriber->ip_address ?? 'N/A',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
