<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admissions Report</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #667eea;
            color: white;
            padding: 8px;
            text-align: left;
            font-size: 9pt;
            font-weight: bold;
        }
        td {
            padding: 6px 8px;
            border-bottom: 1px solid #ddd;
            font-size: 9pt;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .status {
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 8pt;
            font-weight: bold;
            display: inline-block;
        }
        .status-pending {
            background-color: #ffc107;
            color: #000;
        }
        .status-under-review {
            background-color: #17a2b8;
            color: #fff;
        }
        .status-approved {
            background-color: #28a745;
            color: #fff;
        }
        .status-rejected {
            background-color: #dc3545;
            color: #fff;
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
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ config('app.name') }}</h1>
        <p>Admissions Report</p>
    </div>

    <div class="info-box">
        <p><strong>Report Generated:</strong> {{ now()->format('F d, Y h:i A') }}</p>
        <p><strong>Total Applications:</strong> {{ $admissions->count() }}</p>
        <p><strong>Status Breakdown:</strong>
            Pending: {{ $admissions->where('status', 'Pending')->count() }} |
            Under Review: {{ $admissions->where('status', 'Under Review')->count() }} |
            Approved: {{ $admissions->where('status', 'Approved')->count() }} |
            Rejected: {{ $admissions->where('status', 'Rejected')->count() }}
        </p>
    </div>

    @if($admissions->count() > 0)
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 20%;">Name</th>
                <th style="width: 15%;">Email</th>
                <th style="width: 10%;">Grade Level</th>
                <th style="width: 15%;">Application Date</th>
                <th style="width: 12%;">Status</th>
                <th style="width: 23%;">Guardian</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admissions as $admission)
            <tr>
                <td>{{ $admission->id }}</td>
                <td>{{ $admission->full_name }}</td>
                <td style="font-size: 8pt;">{{ $admission->email }}</td>
                <td>{{ $admission->grade_level }}</td>
                <td>{{ $admission->created_at->format('M d, Y') }}</td>
                <td>
                    <span class="status status-{{ strtolower(str_replace(' ', '-', $admission->status)) }}">
                        {{ $admission->status }}
                    </span>
                </td>
                <td style="font-size: 8pt;">{{ $admission->guardian_name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p style="text-align: center; padding: 40px; color: #666;">No admission applications found.</p>
    @endif

    <div class="footer">
        <p>{{ config('app.name') }} - Admissions Report | Page <span class="page-number"></span></p>
    </div>
</body>
</html>
