<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Mail\FeedbackReplyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    /**
     * Display a listing of feedback
     */
    public function index(Request $request)
    {
        $query = Feedback::active();

        // Filter by type (Concern in database)
        if ($request->has('type') && $request->type !== 'all') {
            $query->where('Concern', $request->type);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('feedback_by', 'like', "%{$search}%")
                  ->orWhere('about', 'like', "%{$search}%")
                  ->orWhere('Concern', 'like', "%{$search}%");
            });
        }

        $feedbacks = $query->orderBy('date_entry', 'desc')->paginate(15);

        // Count by type
        $counts = [
            'all' => Feedback::active()->count(),
            'Complaint' => Feedback::active()->complaints()->count(),
            'Suggestion' => Feedback::active()->suggestions()->count(),
            'Compliment' => Feedback::active()->compliments()->count(),
        ];

        return view('admin.feedback.index', compact('feedbacks', 'counts'));
    }

    /**
     * Display the specified feedback
     */
    public function show(Feedback $feedback)
    {
        return view('admin.feedback.show', compact('feedback'));
    }

    /**
     * Remove the specified feedback
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->softDelete();

        return redirect()
            ->route('admin.feedback.index')
            ->with('success', 'Feedback deleted successfully!');
    }

    /**
     * Bulk delete feedback
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:feedback,id',
        ]);

        try {
            $deletedCount = 0;

            foreach ($request->ids as $id) {
                $feedback = Feedback::find($id);
                if ($feedback) {
                    $feedback->softDelete();
                    $deletedCount++;
                }
            }

            return redirect()
                ->route('admin.feedback.index')
                ->with('success', $deletedCount . ' feedback item(s) deleted successfully!');

        } catch (\Exception $e) {
            \Log::error('Bulk delete feedback failed: ' . $e->getMessage());

            return redirect()
                ->route('admin.feedback.index')
                ->with('error', 'An error occurred while deleting feedback. Please try again.');
        }
    }

    /**
     * Reply to feedback
     */
    public function reply(Request $request, Feedback $feedback)
    {
        $request->validate([
            'reply' => 'required|string|min:10',
            'status' => 'required|in:New,In Progress,Resolved,Closed',
        ]);

        $feedback->update([
            'reply' => $request->reply,
            'reply_by' => auth()->id(),
            'reply_date' => now(),
            'status' => $request->status,
        ]);

        // Send email notification to user if email exists
        if ($feedback->email) {
            try {
                Mail::to($feedback->email)->send(new FeedbackReplyMail($feedback));
            } catch (\Exception $e) {
                // Log error but don't fail the request
                \Log::error('Failed to send feedback reply email: ' . $e->getMessage());
            }
        }

        return redirect()
            ->route('admin.feedback.show', $feedback)
            ->with('success', 'Reply sent successfully!' . ($feedback->email ? ' Email notification sent to user.' : ''));
    }

    /**
     * Update feedback status
     */
    public function updateStatus(Request $request, Feedback $feedback)
    {
        $request->validate([
            'status' => 'required|in:New,In Progress,Resolved,Closed',
        ]);

        $feedback->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.feedback.index')
            ->with('success', 'Status updated successfully!');
    }

    /**
     * Export feedback to PDF
     */
    public function export(Request $request)
    {
        $query = Feedback::active();

        // Apply same filters as index
        if ($request->has('type') && $request->type !== 'all') {
            $query->where('Concern', $request->type);
        }

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('feedback_by', 'like', "%{$search}%")
                  ->orWhere('about', 'like', "%{$search}%");
            });
        }

        $feedbacks = $query->orderBy('date_entry', 'desc')->get();

        $pdf = \PDF::loadView('admin.feedback.pdf', compact('feedbacks'));

        return $pdf->download('feedback-report-' . now()->format('Y-m-d') . '.pdf');
    }
}
