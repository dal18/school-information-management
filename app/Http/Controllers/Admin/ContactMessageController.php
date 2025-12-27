<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReplyMail;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of contact messages.
     */
    public function index(Request $request)
    {
        $query = ContactMessage::with(['user', 'repliedByUser'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $messages = $query->paginate(15);

        // Get counts for filter badges
        $counts = [
            'all' => ContactMessage::count(),
            'unread' => ContactMessage::where('status', 'unread')->count(),
            'read' => ContactMessage::where('status', 'read')->count(),
            'responded' => ContactMessage::where('status', 'responded')->count(),
        ];

        return view('admin.contact-messages.index', compact('messages', 'counts'));
    }

    /**
     * Display the specified contact message.
     */
    public function show(ContactMessage $contactMessage)
    {
        $contactMessage->load(['user', 'repliedByUser']);

        // Mark as read if unread
        if ($contactMessage->status === 'unread') {
            $contactMessage->markAsRead();
        }

        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    /**
     * Store the reply to a contact message.
     */
    public function reply(Request $request, ContactMessage $contactMessage)
    {
        $validated = $request->validate([
            'admin_reply' => 'required|string|min:10',
        ]);

        // Update the contact message with reply
        $contactMessage->update([
            'admin_reply' => $validated['admin_reply'],
            'replied_at' => now(),
            'replied_by' => auth()->id(),
            'status' => 'responded',
            'user_has_seen_reply' => false,
        ]);

        // Send email notification
        try {
            Mail::to($contactMessage->email)->send(new ContactReplyMail($contactMessage));
            $emailStatus = 'Email notification sent successfully!';
        } catch (\Exception $e) {
            $emailStatus = 'Reply saved but email notification failed: ' . $e->getMessage();
        }

        return redirect()
            ->route('admin.contact-messages.show', $contactMessage)
            ->with('success', 'Reply sent successfully! ' . $emailStatus);
    }

    /**
     * Delete a contact message.
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()
            ->route('admin.contact-messages.index')
            ->with('success', 'Contact message deleted successfully!');
    }

    /**
     * Mark message as read.
     */
    public function markAsRead(ContactMessage $contactMessage)
    {
        $contactMessage->markAsRead();

        return redirect()
            ->back()
            ->with('success', 'Message marked as read!');
    }

    /**
     * Bulk delete selected messages.
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'message_ids' => 'required|array',
            'message_ids.*' => 'exists:contact_messages,id',
        ]);

        try {
            $deletedCount = ContactMessage::whereIn('id', $request->message_ids)->delete();

            return redirect()
                ->route('admin.contact-messages.index')
                ->with('success', $deletedCount . ' message(s) deleted successfully!');

        } catch (\Exception $e) {
            \Log::error('Bulk delete contact messages failed: ' . $e->getMessage());

            return redirect()
                ->route('admin.contact-messages.index')
                ->with('error', 'An error occurred while deleting messages. Please try again.');
        }
    }
}
