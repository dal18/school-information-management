<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Reply</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background: #f8f9fa;
            padding: 30px;
            border: 1px solid #e9ecef;
        }
        .feedback-box {
            background: white;
            padding: 20px;
            border-left: 4px solid #667eea;
            margin: 20px 0;
            border-radius: 4px;
        }
        .reply-box {
            background: #e7f3ff;
            padding: 20px;
            border-left: 4px solid #0066cc;
            margin: 20px 0;
            border-radius: 4px;
        }
        .label {
            font-weight: bold;
            color: #667eea;
            font-size: 12px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .footer {
            background: #343a40;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            border-radius: 0 0 8px 8px;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
            margin-top: 10px;
        }
        .status-resolved { background: #d4edda; color: #155724; }
        .status-progress { background: #fff3cd; color: #856404; }
        .status-new { background: #d1ecf1; color: #0c5460; }
        .status-closed { background: #e2e3e5; color: #383d41; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0; font-size: 24px;">📬 Feedback Reply</h1>
        <p style="margin: 10px 0 0 0; opacity: 0.9;">School Information Management System</p>
    </div>

    <div class="content">
        <p>Hello <strong>{{ $feedback->feedback_by }}</strong>,</p>

        <p>Thank you for your feedback! We have reviewed your {{ strtolower($feedback->Concern) }} and would like to respond.</p>

        <div class="feedback-box">
            <div class="label">Your Original Feedback</div>
            <p style="margin: 10px 0 0 0;">{{ $feedback->about }}</p>
            <div style="margin-top: 10px;">
                <span class="label">Type:</span> {{ $feedback->Concern }}
            </div>
            <div style="margin-top: 5px; color: #6c757d; font-size: 12px;">
                Submitted on {{ $feedback->date_entry->format('F d, Y') }}
            </div>
        </div>

        <div class="reply-box">
            <div class="label" style="color: #0066cc;">Our Response</div>
            <p style="margin: 10px 0 0 0;">{{ $feedback->reply }}</p>
            @if($feedback->repliedBy)
            <div style="margin-top: 10px; color: #6c757d; font-size: 12px;">
                <strong>Replied by:</strong> {{ $feedback->repliedBy->name }}
            </div>
            @endif
            <div style="margin-top: 5px; color: #6c757d; font-size: 12px;">
                {{ $feedback->reply_date->format('F d, Y - h:i A') }}
            </div>
        </div>

        <div style="margin-top: 20px;">
            <div class="label">Status Update</div>
            <span class="status-badge status-{{ strtolower(str_replace(' ', '', $feedback->status)) }}">
                {{ $feedback->status }}
            </span>
        </div>

        <p style="margin-top: 30px;">
            We value your input and appreciate you taking the time to share your thoughts with us.
            @if($feedback->status !== 'Closed')
            If you have any further questions or concerns, please don't hesitate to reach out.
            @endif
        </p>

        <p>Best regards,<br>
        <strong>SIMS Administration Team</strong></p>
    </div>

    <div class="footer">
        <p style="margin: 0;">© {{ date('Y') }} School Information Management System. All rights reserved.</p>
        <p style="margin: 10px 0 0 0; opacity: 0.8;">This is an automated message. Please do not reply to this email.</p>
    </div>
</body>
</html>
