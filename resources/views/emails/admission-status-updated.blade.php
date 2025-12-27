<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Status Update</title>
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
        .status-box {
            background-color: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .status-box.approved {
            border-left-color: #28a745;
            background-color: #d4edda;
        }
        .status-box.rejected {
            border-left-color: #dc3545;
            background-color: #f8d7da;
        }
        .status-box.under-review {
            border-left-color: #ffc107;
            background-color: #fff3cd;
        }
        .status-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #666;
            margin-bottom: 5px;
        }
        .status-value {
            font-size: 24px;
            font-weight: bold;
            margin: 5px 0;
        }
        .status-value.approved {
            color: #28a745;
        }
        .status-value.rejected {
            color: #dc3545;
        }
        .status-value.under-review {
            color: #ffc107;
        }
        .status-value.pending {
            color: #6c757d;
        }
        .application-details {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            margin: 20px 0;
        }
        .detail-row {
            display: flex;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: bold;
            width: 150px;
            color: #666;
            flex-shrink: 0;
        }
        .detail-value {
            color: #333;
        }
        .notes-section {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
        }
        .notes-section h3 {
            margin-top: 0;
            color: #667eea;
            font-size: 16px;
        }
        .notes-text {
            color: #555;
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
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 4px;
            margin: 15px 0;
            font-weight: bold;
        }
        .info-box {
            background-color: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-box p {
            margin: 0;
            color: #1976d2;
        }
        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 0;
            }
            .email-body {
                padding: 20px;
            }
            .detail-row {
                flex-direction: column;
            }
            .detail-label {
                width: 100%;
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Email Header -->
        <div class="email-header">
            <h1>{{ config('app.name') }}</h1>
            <p style="margin: 5px 0 0 0; font-size: 14px;">Admission Application Status Update</p>
        </div>

        <!-- Email Body -->
        <div class="email-body">
            <div class="greeting">
                <p>Dear {{ $admission->full_name }},</p>
            </div>

            <p>We are writing to inform you about an update to your admission application status.</p>

            <!-- Status Update Box -->
            <div class="status-box {{ strtolower(str_replace(' ', '-', $admission->status)) }}">
                @if($oldStatus)
                <div style="margin-bottom: 15px;">
                    <div class="status-label">Previous Status</div>
                    <div style="font-size: 16px; color: #666;">{{ $oldStatus }}</div>
                </div>
                <div style="text-align: center; margin: 10px 0; color: #666;">
                    ↓
                </div>
                @endif
                <div class="status-label">Current Status</div>
                <div class="status-value {{ strtolower(str_replace(' ', '-', $admission->status)) }}">
                    {{ $admission->status }}
                </div>
            </div>

            <!-- Application Details -->
            <div class="application-details">
                <h3 style="margin-top: 0; color: #667eea;">Application Details</h3>
                <div class="detail-row">
                    <div class="detail-label">Applicant Name:</div>
                    <div class="detail-value">{{ $admission->full_name }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Grade Level:</div>
                    <div class="detail-value">{{ $admission->grade_level }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Application Date:</div>
                    <div class="detail-value">{{ $admission->created_at->format('F d, Y') }}</div>
                </div>
                <div class="detail-row">
                    <div class="detail-label">Application ID:</div>
                    <div class="detail-value">#{{ $admission->id }}</div>
                </div>
            </div>

            <!-- Notes from Admin (if any) -->
            @if($admission->notes)
            <div class="notes-section">
                <h3>Additional Notes</h3>
                <div class="notes-text">{{ $admission->notes }}</div>
            </div>
            @endif

            <!-- Status-specific messages -->
            @if($admission->status === 'Approved')
            <div class="info-box" style="background-color: #d4edda; border-left-color: #28a745;">
                <p style="color: #155724;">
                    <strong>Congratulations!</strong> Your admission application has been approved. We will contact you soon with the next steps for enrollment.
                </p>
            </div>
            @elseif($admission->status === 'Under Review')
            <div class="info-box" style="background-color: #fff3cd; border-left-color: #ffc107;">
                <p style="color: #856404;">
                    Your application is currently under review. Our admissions team is carefully evaluating your application. We will notify you once a decision has been made.
                </p>
            </div>
            @elseif($admission->status === 'Rejected')
            <div class="info-box" style="background-color: #f8d7da; border-left-color: #dc3545;">
                <p style="color: #721c24;">
                    We regret to inform you that we are unable to approve your application at this time. If you have any questions, please feel free to contact our admissions office.
                </p>
            </div>
            @elseif($admission->status === 'Pending')
            <div class="info-box">
                <p>
                    Your application has been received and is pending initial review. We will update you once the review process begins.
                </p>
            </div>
            @endif

            <p style="margin-top: 25px;">
                For any questions or concerns regarding your application, please contact our admissions office at <strong>{{ config('mail.from.address') }}</strong> or call us during office hours.
            </p>

            <p style="margin-top: 20px;">
                <strong>Best regards,</strong><br>
                Admissions Office<br>
                {{ config('app.name') }}
            </p>
        </div>

        <!-- Email Footer -->
        <div class="email-footer">
            <p><strong>{{ config('app.name') }}</strong></p>
            <p>Providing quality education and nurturing young minds</p>

            <div class="school-info">
                <p>This is an automated email notification. Please do not reply directly to this message.</p>
                <p>For assistance, please contact our admissions office through our official channels.</p>
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
