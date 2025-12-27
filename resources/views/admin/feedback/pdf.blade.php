<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Feedback Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10pt;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #667eea;
            font-size: 24pt;
        }
        .header p {
            margin: 5px 0;
            color: #666;
            font-size: 10pt;
        }
        .info-box {
            background: #f8f9fa;
            padding: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #667eea;
        }
        .info-box p {
            margin: 3px 0;
            font-size: 9pt;
        }
        .feedback-item {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 12px;
            margin-bottom: 15px;
            page-break-inside: avoid;
        }
        .feedback-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            padding-bottom: 8px;
            border-bottom: 1px solid #eee;
        }
        .feedback-meta {
            font-size: 8pt;
            color: #666;
        }
        .concern-type {
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 8pt;
            font-weight: bold;
            display: inline-block;
        }
        .concern-complaint {
            background-color: #dc3545;
            color: #fff;
        }
        .concern-suggestion {
            background-color: #17a2b8;
            color: #fff;
        }
        .concern-compliment {
            background-color: #28a745;
            color: #fff;
        }
        .feedback-content {
            font-size: 9pt;
            line-height: 1.5;
            margin: 10px 0;
            padding: 10px;
            background: #f8f9fa;
            border-left: 3px solid #667eea;
        }
        .feedback-reply {
            margin-top: 10px;
            padding: 10px;
            background: #e7f3ff;
            border-left: 3px solid #17a2b8;
        }
        .reply-label {
            font-weight: bold;
            color: #17a2b8;
            font-size: 8pt;
            margin-bottom: 5px;
        }
        .reply-content {
            font-size: 8pt;
            color: #333;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 8pt;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 5px;
        }
        .page-number:after {
            content: counter(page);
        }
        .summary-table {
            width: 100%;
            margin: 15px 0;
        }
        .summary-table td {
            padding: 5px;
            font-size: 9pt;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ config('app.name') }}</h1>
        <p>Feedback & Suggestions Report</p>
    </div>

    <div class="info-box">
        <p><strong>Report Generated:</strong> {{ now()->format('F d, Y h:i A') }}</p>
        <p><strong>Total Feedback:</strong> {{ $feedbacks->count() }}</p>
        <table class="summary-table">
            <tr>
                <td><strong>Complaints:</strong> {{ $feedbacks->where('Concern', 'Complaint')->count() }}</td>
                <td><strong>Suggestions:</strong> {{ $feedbacks->where('Concern', 'Suggestion')->count() }}</td>
                <td><strong>Compliments:</strong> {{ $feedbacks->where('Concern', 'Compliment')->count() }}</td>
            </tr>
            <tr>
                <td><strong>With Reply:</strong> {{ $feedbacks->whereNotNull('reply')->count() }}</td>
                <td><strong>Pending:</strong> {{ $feedbacks->whereNull('reply')->count() }}</td>
                <td></td>
            </tr>
        </table>
    </div>

    @if($feedbacks->count() > 0)
        @foreach($feedbacks as $index => $feedback)
        <div class="feedback-item">
            <div class="feedback-header">
                <div>
                    <strong style="font-size: 10pt;">{{ $feedback->feedback_by }}</strong>
                    <br>
                    <span class="feedback-meta">
                        Submitted: {{ $feedback->date_entry ? $feedback->date_entry->format('M d, Y h:i A') : 'N/A' }}
                    </span>
                </div>
                <div style="text-align: right;">
                    <span class="concern-type concern-{{ strtolower($feedback->Concern) }}">
                        {{ $feedback->Concern }}
                    </span>
                    <br>
                    <span class="feedback-meta">ID: #{{ $feedback->id }}</span>
                </div>
            </div>

            <div class="feedback-content">
                {{ $feedback->about }}
            </div>

            @if($feedback->reply)
            <div class="feedback-reply">
                <div class="reply-label">
                    Admin Reply
                    @if($feedback->reply_date)
                    ({{ $feedback->reply_date->format('M d, Y') }})
                    @endif
                </div>
                <div class="reply-content">
                    {{ $feedback->reply }}
                </div>
            </div>
            @endif

            @if($feedback->status)
            <div style="margin-top: 8px; font-size: 8pt; color: #666;">
                <strong>Status:</strong> {{ $feedback->status }}
            </div>
            @endif
        </div>
        @endforeach
    @else
    <p style="text-align: center; padding: 40px; color: #666;">No feedback records found.</p>
    @endif

    <div class="footer">
        <p>{{ config('app.name') }} - Feedback Report | Page <span class="page-number"></span></p>
    </div>
</body>
</html>
