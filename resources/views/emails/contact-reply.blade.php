<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to Your Message</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 30px;
        }
        .greeting {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }
        .original-message {
            background-color: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .original-message h3 {
            margin-top: 0;
            color: #667eea;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .original-message p {
            margin: 5px 0;
            color: #666;
        }
        .reply-content {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            margin: 20px 0;
        }
        .reply-content h3 {
            margin-top: 0;
            color: #667eea;
            font-size: 16px;
        }
        .reply-text {
            color: #333;
            white-space: pre-wrap;
            line-height: 1.8;
        }
        .email-footer {
            background-color: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #e0e0e0;
        }
        .email-footer p {
            margin: 5px 0;
            color: #666;
            font-size: 14px;
        }
        .school-info {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e0e0e0;
        }
        .school-info p {
            margin: 3px 0;
            font-size: 12px;
            color: #888;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #667eea;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            margin: 15px 0;
            font-weight: bold;
        }
        .button:hover {
            background-color: #764ba2;
        }
        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 0;
            }
            .email-body {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Email Header -->
        <div class="email-header">
            <h1>Little Flower High School</h1>
            <p style="margin: 5px 0 0 0; font-size: 14px;">Response to Your Message</p>
        </div>

        <!-- Email Body -->
        <div class="email-body">
            <div class="greeting">
                <p>Dear {{ $contactMessage->name }},</p>
            </div>

            <p>Thank you for contacting Little Flower High School. We have reviewed your message and are pleased to provide you with the following response:</p>

            <!-- Original Message Reference -->
            <div class="original-message">
                <h3>Your Original Message</h3>
                <p><strong>Subject:</strong> {{ $contactMessage->subject }}</p>
                <p><strong>Date:</strong> {{ $contactMessage->created_at->format('F d, Y \a\t h:i A') }}</p>
                <p style="margin-top: 10px; font-style: italic; color: #555;">
                    "{{ Str::limit($contactMessage->message, 150) }}"
                </p>
            </div>

            <!-- Admin Reply -->
            <div class="reply-content">
                <h3>Our Response</h3>
                <div class="reply-text">{{ $contactMessage->admin_reply }}</div>
            </div>

            <p style="margin-top: 20px;">
                If you have any additional questions or concerns, please don't hesitate to reach out to us again. We're here to help!
            </p>

            <p style="margin-top: 20px;">
                <strong>Best regards,</strong><br>
                {{ $contactMessage->repliedByUser->name ?? 'Administration' }}<br>
                Little Flower High School
            </p>
        </div>

        <!-- Email Footer -->
        <div class="email-footer">
            <p><strong>Little Flower High School</strong></p>
            <p>Providing quality education and nurturing young minds</p>

            <div class="school-info">
                <p>This is an automated email. Please do not reply directly to this message.</p>
                <p>For further assistance, please visit our website or contact us through our official channels.</p>
                <p>&copy; {{ date('Y') }} Little Flower High School. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
